<?php

namespace App\Controller;

use App\Entity\OffreR;
use App\Entity\RechercheOffre;
use App\Form\OffreRType;
use App\Form\RechercheOffreType;
use App\Repository\OffreRRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class OffreRController extends AbstractController
{
    #[Route('/offre/liste', name: 'liste_offre')]
    public function index(Request $request, ManagerRegistry $registry, OffreRRepository $OffreRRepository): Response
    {
        $rechercher = new RechercheOffre();
        $form = $this->createForm(RechercheOffreType::class, $rechercher);
        $form->handleRequest($request);

        $offres = [];
        $offres = $registry->getRepository(OffreR::class)->findAll();

        $qb = $OffreRRepository->createQueryBuilder('r');
        $qb->select('r.datefin_offr, COUNT(r.id) as nb_offr_same_date')
    ->groupBy('r.datefin_offr')
    ->orderBy('r.datefin_offr', 'DESC'); // Order by date in ascending order
 
 $results = $qb->getQuery()->getResult();

        if ($form->isSubmitted() && $form->isValid()) {
            $nomfilm_offr = $rechercher->getNomfilmOffr();
            if ($nomfilm_offr != "")
                $offres = $registry->getRepository(OffreR::class)->findBy(['nomfilm_offr' => $nomfilm_offr]);
            else
                $offres = $registry->getRepository(OffreR::class)->findAll();
        }
        return  $this->render('offre_r/index.html.twig', ['form' => $form->createView(), 'offres' => $offres, 'results' => $results]);
    }

    #[Route('/offre/ajout', name: 'ajout_offre')]
    public function ajoutOffre(Request $request, ManagerRegistry $Registry)
    {
        $offrer = new OffreR();
        $form = $this->createForm(OffreRType::class, $offrer);
        $form->handleRequest($request);
        $entitymanager = $Registry->getManager();
        if ($form->isSubmitted()) {
            $entitymanager->persist($offrer);
            $entitymanager->flush();
            return $this->redirectToRoute('ajout_offre');
        }
        return $this->render('offre_r/ajoutOffre.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/offre/details/{id}', name: 'details_offre')]
    public function detailsOffre($id, ManagerRegistry $registry): Response
    {
        $offrer = $registry->getRepository(OffreR::class)->find($id);
        return $this->render('offre_r/detailsOffre.html.twig', array('offre' => $offrer));
    }

    #[Route('/offre/modif/{id}', name: 'modif_offre')]
    public function modifOffre(Request $request, $id, ManagerRegistry $registry)
    {
        $offrer = new OffreR();
        $offrer = $registry->getRepository(OffreR::class)->find($id);

        $form = $this->createForm(OffreRType::class, $offrer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $registry->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_offre');
        }

        return $this->render('offre_r/modifOffre.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/offre/supp/{id}', name: 'supp_offre')]
    public function suppOffre(Request $request, $id, ManagerRegistry $registry)
    {
        $offrer = $registry->getRepository(OffreR::class)->find($id);

        $entityManager = $registry->getManager();
        $entityManager->remove($offrer);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('liste_offre');
    }
}
