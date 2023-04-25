<?php

namespace App\Controller;

use App\Entity\Parking;
use App\Form\ParkingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ParkingController extends AbstractController
{
    #[Route('/parking/liste', name: 'liste-parking')]
    public function getParkings(Request $request): Response
    {
        $parkings = $this->getDoctrine()->getRepository(Parking::class)->findAll();
        return $this->render('parking/back/index.html.twig', [
            'parkings'=>$parkings
        ]);
    }

    #[Route('/parking/ajout', name: 'ajout-parking')]
    public function addParking(Request $request): Response
    {
        $parking = new Parking();
        $form = $this->createForm(ParkingType::class,$parking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($parking);
            $em->flush();
            return $this->redirectToRoute("liste-parking");
        }
        return $this->render("parking/back/ajoutParking.html.twig",['form'=>$form->createView()]);
    }

    #[Route('/supprimerParking/{id}', name: 'delete-parking')]
    public function supprimerParking(Parking $parking): Response
    {
        $em = $this->getDoctrine()->getManager();
        $parking->setLogoParking("");
        $em->remove($parking);
        $em->flush();
        return $this->redirectToRoute("liste-parking");
    }

    #[Route('/modifierParking/{id}', name: 'modifier-parking')]
    public function modifierParking(Request $request,$id): Response
    {
        $parking = $this->getDoctrine()->getRepository(Parking::class)->find($id);
        $form = $this->createForm(ParkingType::class,$parking);
        $form->handleRequest($request);
        $parking->setLogoParking("");
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($parking);
            $em->flush();
            return $this->redirectToRoute("liste-parking");
        }
        return $this->render("parking/back/modifierParking.html.twig",['form'=>$form->createView()]);
    }

    #[Route('/client/parking/liste', name: 'liste-parking-front')]
    public function getParkingsClient(Request $request): Response
    {
        $parkings = $this->getDoctrine()->getRepository(Parking::class)->findAll();
        return $this->render('parking/front/index.html.twig', [
            'parkings'=>$parkings
        ]);
    }

    #[Route('/client/parking-details/{id}', name: 'parking-details')]
    public function parkingDetails(Parking $parking, $id): Response
    {
        $parking = $this->getDoctrine()->getRepository(Parking::class)->find($id);
        return $this->render("parking/front/parkingDetails.html.twig",['parking'=>$parking]);
    }

    public function findByMultiCriteria($txt)
    {
        $entityManager=$this->getDoctrine()->getManager();
        $query=$entityManager
            ->createQuery("SELECT p from App\Entity\Parking p where p.nomParking like :txt or p.capaciteParking like :txt 
            or p.prixParking like :txt ")
            ->setParameter('txt','%'.$txt.'%');
        return $query->getResult();
    }

    /**
     * @Route("/searchParking", name="searchParking")
     * @throws ExceptionInterface
     */
    public function searchParking(Request $request,NormalizerInterface $Normalizer): Response
    {
        $searchValue = $request->query->get('searchValue');
        $em = $this->getDoctrine()->getManager();
        $terrains = $this->findByMultiCriteria($searchValue);
        $jsonContent = $Normalizer->normalize($terrains,
            'json');
        $retour = json_encode($jsonContent);
        return new Response($retour);
    }




}
