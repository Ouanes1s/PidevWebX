<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\RechercheOffre;
use App\Form\OffreType;
use App\Form\RechercheOffreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


class OffreController extends AbstractController
{
    #[Route('/offre/liste', name: 'liste_offre')]
    public function index(Request $request, ManagerRegistry $registry): Response
    {
        $rechercher = new RechercheOffre();
        $form = $this->createForm(RechercheOffreType::class, $rechercher);
        $form->handleRequest($request);

        $offres = [];
        $offres = $registry->getRepository(Offre::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $pourcentage = $rechercher->getPourcentage();
            if ($pourcentage != "")
                $offres = $registry->getRepository(Offre::class)->findBy(['pourcentage' => $pourcentage]);
            else
                $offres = $registry->getRepository(Offre::class)->findAll();
        }
        return  $this->render('offre/index.html.twig', ['form' => $form->createView(), 'offres' => $offres]);
    }

    #[Route('/offre/ajout', name: 'ajout_offre')]
    public function ajoutOffre(Request $request, ManagerRegistry $Registry)
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);
        $entitymanager = $Registry->getManager();
        if ($form->isSubmitted()) {
            $entitymanager->persist($offre);
            $entitymanager->flush();
            return $this->redirectToRoute('ajout_offre');
        }
        return $this->render('offre/ajoutOffre.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/offre/details/{id}', name: 'details_offre')]
    public function detailsOffre($id, ManagerRegistry $registry): Response
    {
        $offre = $registry->getRepository(Offre::class)->find($id);
        return $this->render('offre/detailsOffre.html.twig', array('offre' => $offre));
    }

    #[Route('/offre/modif/{id}', name: 'modif_offre')]
    public function modifOffre(Request $request, $id, ManagerRegistry $registry)
    {
        $offre = new Offre();
        $offre = $registry->getRepository(Offre::class)->find($id);

        $form = $this->createForm(OffreType::class, $offre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $registry->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_offre');
        }

        return $this->render('offre/modifOffre.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/offre/supp/{id}', name: 'supp_offre')]
    public function suppOffre(Request $request, $id, ManagerRegistry $registry)
    {
        $offre = $registry->getRepository(Offre::class)->find($id);

        $entityManager = $registry->getManager();
        $entityManager->remove($offre);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('liste_offre');
    }
}
