<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\User;
use App\Form\ReclamationType;
use App\Form\ReplyReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationController extends AbstractController
{
    #[Route('/reclamation/liste', name: 'liste-reclamation')]
    public function getReclamations(Request $request): Response
    {
        $reclamations = $this->getDoctrine()->getRepository(Reclamation::class)->findAll();
        return $this->render('reclamation/back/index.html.twig', [
            'reclamations'=>$reclamations
        ]);
    }

//    #[Route('/reclamation/ajout', name: 'ajout-reclamation')]
//    public function addReclamation(Request $request): Response
//    {
//        $reclamation = new Reclamation();
//        $reclamation->setEtatReclamation(0);
//        $reclamation->setReponseReclamation("");
//        $form = $this->createForm(ReclamationType::class,$reclamation);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()){
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($reclamation);
//            $em->flush();
//            return $this->redirectToRoute("liste-reclamation");
//        }
//        return $this->render("reclamation/back/ajoutReclamation.html.twig",['form'=>$form->createView()]);
//    }

    #[Route('/supprimerReclamation/{id}', name: 'delete-reclamation')]
    public function supprimerReclamation(Reclamation $reclamation): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute("liste-reclamation");
    }

   /* #[Route('/modifierReclamation/{id}', name: 'modifier-reclamation')]
    public function modifierReclamation(Request $request,$id): Response
    {
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        $form = $this->createForm(ReclamationType::class,$reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute("liste-reclamation");
        }
        return $this->render("reclamation/back/repondreReclamation.html.twig",['form'=>$form->createView()]);
    }*/

    // Repondre Reclamation
    #[Route('/modifierReclamation/{id}', name: 'modifier-reclamation')]
    public function repondreReclamation(Request $request,$id): Response
    {
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        $form = $this->createForm(ReplyReclamationType::class,$reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute("liste-reclamation");
        }
        return $this->render("reclamation/back/repondreReclamation.html.twig",['form'=>$form->createView(), 'reclamation' => $reclamation]);
    }

    #[Route('/', name: 'mycinema-front')]
    public function myCinemaClient(Request $request): Response
    {
        return $this->render('reclamation/front/index.html.twig');
    }

    #[Route('/client/reclamation/ajout', name: 'ajout-reclamation-front')]
    public function ajoutReclamationClient(Request $request): Response
    {
        $reclamation = new Reclamation();
        $reclamation->setEtatReclamation(0);
        $reclamation->setReponseReclamation("");
        $form = $this->createForm(ReclamationType::class,$reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute("mycinema-front");
        }
        return $this->render("reclamation/front/ajoutReclamation.html.twig",['form'=>$form->createView()]);
    }
}
