<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\RechercheProduit_Nom;
use App\Form\ProduitType;
use App\Form\RechercheProdNomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

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
    public function ajoutProduit(Request $request, ManagerRegistry $registry)
    {
        $produit = new Produit();

        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
}
