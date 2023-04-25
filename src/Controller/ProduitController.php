<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\RecherchePrix;
use App\Entity\RechercheProduit_Nom;
use App\Form\ProduitType;
use App\Form\RechercheProdNomType;
use App\Entity\RechercheProduit_Categ;
use App\Entity\RechercheProduit_Offre;
use App\Form\RecherchePrixType;
use App\Form\RechercheProduitCategType;
use App\Form\RechercheProduitOffreType;
use App\Repository\ProduitRepository;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProduitController extends AbstractController
{

    #[Route('/produit/liste', name: 'liste_produit')]
    public function home(Request $request, ManagerRegistry $registry)
    {
        $rechercher = new RechercheProduit_Nom();
        $form = $this->createForm(RechercheProdNomType::class, $rechercher);
        $form->handleRequest($request);
        $produits = [];
        $produits = $registry->getRepository(Produit::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $productname = $rechercher->getProductname();
            if ($productname != "")
                $produits = $registry->getRepository(Produit::class)->findBy(['productname' => $productname]);
            else
                $produits = $registry->getRepository(Produit::class)->findAll();
        }
        return  $this->render('produit/index.html.twig', ['form' => $form->createView(), 'produits' => $produits]);
    }

    #[Route('/produit/ajout', name: 'ajout_produit')]
    public function ajoutProduit(Request $request, ManagerRegistry $registry, SluggerInterface $slugger)
    {
        $produit = new Produit();

        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $brochureFile = $form->get('photo')->getData();

            if ($brochureFile) {
                $originalFilename = pathinfo($produit->getId(), flags: PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                try {
                    $brochureFile->move(
                        $this->getParameter('produit_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $produit->setImage($newFilename);
                $filePaths[] = $newFilename;
            }
            $produit = $form->getData();

            $entityManager = $registry->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('ajout_produit');
        }
        return $this->render('produit/ajoutProduit.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/produit/details/{id}', name: 'details_produit')]
    public function detailsProduit($id, ManagerRegistry $registry): Response
    {
        $produit = $registry->getRepository(Produit::class)->find($id);
        return $this->render('produit/detailsProduit.html.twig', array('produit' => $produit));
    }

    #[Route('/produit/modif/{id}', name: 'modif_produit')]
    public function modifProduit(Request $request, $id, ManagerRegistry $registry)
    {
        $produit = new Produit();
        $produit = $registry->getRepository(Produit::class)->find($id);

        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $registry->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_produit');
        }

        return $this->render('produit/modifProduit.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/produit/supp/{id}', name: 'supp_produit')]
    public function suppProduit(Request $request, $id, ManagerRegistry $registry)
    {
        $produit = $registry->getRepository(Produit::class)->find($id);

        $entityManager = $registry->getManager();
        $entityManager->remove($produit);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('liste_produit');
    }

    #[Route('/produit/rechercheCat', name: 'produit_rechercheCat')]
    public function RechercherParCategorie(Request $request, ManagerRegistry $doctrine)
    {
        $RechercheProduit_Categ = new RechercheProduit_Categ();
        $form = $this->createForm(RechercheProduitCategType::class, $RechercheProduit_Categ);
        $form->handleRequest($request);

        //$articles = [];
        $produits = $doctrine->getRepository(Produit::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $RechercheProduit_Categ->getCategorie();

            if ($categorie != "") {

                $produits = $categorie->getProduits();
                // ou bien 
                //$articles= $doctrine->getRepository(Article::class)->findBy(['categorie' => $categorie] );
            } else
                $produits = $doctrine->getRepository(Produit::class)->findAll();
        }

        return $this->render('produit/rechercheParCategorie.html.twig', ['form' => $form->createView(), 'produits' => $produits]);
    }

    #[Route('/produit/recherchePrix', name: 'produit_recherchePrix')]
    public function RechercherParPrix(Request $request, ManagerRegistry $doctrine, ProduitRepository $repo)
    {
        $recherchePrix = new RecherchePrix();
        $form = $this->createForm(RecherchePrixType::class, $recherchePrix);
        $form->handleRequest($request);

        $produits = $doctrine->getRepository(Produit::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $minPrice = $recherchePrix->getMinPrice();
            $maxPrice = $recherchePrix->getMaxPrice();

            //$articles = $doctrine->getRepository(Article::class)->findByPriceRange($minPrice, $maxPrice);
            $produits = $repo->findByPriceRange($minPrice, $maxPrice);
        }

        return  $this->render('produit/rechercheParPrix.html.twig', ['form' => $form->createView(), 'produits' => $produits]);
    }

    #[Route('/produit/rechercheProd_Offre', name: 'produit_rechercheOffre')]
    public function RechercherParOffre(Request $request, ManagerRegistry $doctrine)
    {
        $RechercheProduit_Offre = new RechercheProduit_Offre();
        $form = $this->createForm(RechercheProduitOffreType::class, $RechercheProduit_Offre);
        $form->handleRequest($request);

        $produits = $doctrine->getRepository(Produit::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $offre = $RechercheProduit_Offre->getOffre();

            if ($offre != "") {

                $produits = $offre->getProduits();
                // ou bien 
                //$articles= $doctrine->getRepository(Article::class)->findBy(['categorie' => $categorie] );
            } else
                $produits = $doctrine->getRepository(Produit::class)->findAll();
        }

        return $this->render('produit/rechercheParOffre.html.twig', ['form' => $form->createView(), 'produits' => $produits]);
    }

    #[Route('/produit/triProd_Offre', name: 'triProd_Offre')]
    public function trierParOffre(EntityManagerInterface $entityManager)
    {
        $produits = $entityManager->getRepository(Produit::class)
            ->createQueryBuilder('p')
            ->leftJoin('p.Offre', 'o')
            ->orderBy('o.pourcentage', 'DESC')
            ->getQuery()
            ->getResult();
        return $this->render('produit/ProduitsTries.html.twig', ['produits' => $produits]);
    }

    #[Route('/produit/triPrixCher', name: 'triPrixCher')]
    public function trierParPrixPlusCher(ManagerRegistry $registry): Response
    {
        $produits = $registry
            ->getRepository(Produit::class)
            ->findBy([], ['purchaseprice' => 'DESC']);

        return $this->render('produit/ProduitsTries.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/produit/triPrixBas', name: 'triPrixBas')]
    public function trierParPlusBasPrix(ManagerRegistry $registry): Response
    {
        $produits = $registry
            ->getRepository(Produit::class)
            ->findBy([], ['purchaseprice' => 'ASC']);

        return $this->render('produit/ProduitsTries.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/produit/enstock', name: 'enstock')]
    public function produitsEnStock(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findByEtat(1);

        return $this->render('produit/ProduitsTries.html.twig', [
            'produits' => $produits,
        ]);
    }
}
