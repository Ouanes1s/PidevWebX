<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\RechercheCategorie;
use App\Form\CategorieType;
use App\Form\RechercheCategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class CategorieController extends AbstractController
{
    #[Route('/categorie/liste', name: 'liste_categorie')]
    public function home(Request $request, ManagerRegistry $registry)
    {
        $rechercher = new RechercheCategorie();
        $form = $this->createForm(RechercheCategorieType::class, $rechercher);
        $form->handleRequest($request);
        //initialement le tableau des categorie est vide, 
        //c.a.d on affiche les categorie que lorsque l'utilisateur clique sur le bouton rechercher
        $categories = [];
        $categories = $registry->getRepository(Categorie::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère le nom d'Categorie tapé dans le formulaire
            $nom = $rechercher->getNom();
            if ($nom != "")
                //si on a fourni un nom d'Categorie on affiche tous les categorie ayant ce nom
                $categories = $registry->getRepository(Categorie::class)->findBy(['nom' => $nom]);
            else
                //si si aucun nom n'est fourni on affiche tous les categorie
                $categories = $registry->getRepository(Categorie::class)->findAll();
        }
        return  $this->render('categorie/index.html.twig', ['form' => $form->createView(), 'categories' => $categories]);
    }

    #[Route('/categorie/ajout', name: 'ajout_categorie')]
    public function ajoutCategorie(Request $request, ManagerRegistry $Registry)
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        $entitymanager = $Registry->getManager();
        if ($form->isSubmitted()) {
            $entitymanager->persist($categorie);
            $entitymanager->flush();
            return $this->redirectToRoute('ajout_categorie');
        }
        return $this->render('categorie/ajoutCategorie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/categorie/details/{id}', name: 'details_categorie')]
    public function detailsCategorie($id, ManagerRegistry $registry): Response
    {
        $categorie = $registry->getRepository(Categorie::class)->find($id);
        return $this->render('categorie/detailsCategorie.html.twig', array('categorie' => $categorie));
    }

    #[Route('/categorie/modif/{id}', name: 'modif_categorie')]
    public function modifCategorie(Request $request, $id, ManagerRegistry $registry)
    {
        $categorie = new Categorie();
        $categorie = $registry->getRepository(Categorie::class)->find($id);

        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $registry->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_categorie');
        }

        return $this->render('categorie/modifCategorie.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/categorie/supp/{id}', name: 'supp_categorie')]
    public function suppCategorie(Request $request, $id, ManagerRegistry $registry)
    {
        $categorie = $registry->getRepository(Categorie::class)->find($id);

        $entityManager = $registry->getManager();
        $entityManager->remove($categorie);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('liste_categorie');
    }
}
