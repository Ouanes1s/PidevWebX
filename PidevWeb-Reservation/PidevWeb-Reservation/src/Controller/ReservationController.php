<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\RechercheReservation;
use App\Form\ReservationType;
use App\Form\RechercheReservationType;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Services\MailerService;
use Symfony\Component\Mime\Email;


class ReservationController extends AbstractController
{
    #[Route('/reservation/liste', name: 'liste_reservation')]
    public function index(Request $request, ManagerRegistry $registry,ReservationRepository $ReservationRepository): Response
    {   
        $rechercher = new RechercheReservation();
        $form = $this->createForm(RechercheReservationType::class, $rechercher);
        $form->handleRequest($request);

        $reservations = [];
        $reservations = $registry->getRepository(Reservation::class)->findAll();
        //Get the number of reservations with the Date 
        $qb = $ReservationRepository->createQueryBuilder('r');
       $qb->select('r.date_res, COUNT(r.id) as nb_res_same_date')
   ->groupBy('r.date_res')
   ->orderBy('r.date_res', 'ASC'); // Order by date_res in ascending order

   $results = $qb->getQuery()->getResult();
   

    if ($form->isSubmitted() && $form->isValid()) {
            
            $email_res = $rechercher->getEmailRes();
            if ($email_res != "")
                $reservations = $registry->getRepository(Reservation::class)->findBy(['email_res' => $email_res]);
            else
                $reservations = $registry->getRepository(Reservation::class)->findAll();

        }
        return  $this->render('reservation/index.html.twig', ['form' => $form->createView(), 'reservations' => $reservations, 'results' => $results ]);
    
     
    
    }

    #[Route('/reservation/ajout', name: 'ajout_reservation')]
    public function ajoutReservation(Request $request, ManagerRegistry $Registry,MailerService $mailerservice)
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        $entitymanager = $Registry->getManager();
        if ($form->isSubmitted()&& $form->isValid() ) {
           $data = $form->getData();
$mail = (new Email())
    ->subject('Confirmation Reservation')
    ->from('amine.khalfaoui@esprit.tn')
    ->to('amine.khalfaoui98@gmail.com')
    ->htmlTemplate('email/contact.html.twig')
    ->context([
        'name' => $data['nom_res'],
        'date' => $data['date_res']
    ]);

$mailerservice->send($mail);


            $entitymanager->persist($reservation);
            $entitymanager->flush();


            
            return $this->redirectToRoute('ajout_reservation');
            
        }

        
        return $this->render('reservation/ajoutReservation.html.twig', [
            'form' => $form->createView()
        ]);
 
    }

    #[Route('/reservation/details/{id}', name: 'details_reservation')]
    public function detailsReservation($id, ManagerRegistry $registry): Response
    {
        $reservation = $registry->getRepository(Reservation::class)->find($id);
        return $this->render('reservation/detailsReservation.html.twig', array('reservation' => $reservation));
    }

    #[Route('/reservation/modif/{id}', name: 'modif_reservation')]
    public function modifReservation(Request $request, $id, ManagerRegistry $registry)
    {
        $reservation = new Reservation();
        $reservation = $registry->getRepository(Reservation::class)->find($id);

        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $registry->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_reservation');
        }

        return $this->render('blog/modifReservation.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/reservation/supp/{id}', name: 'supp_reservation')]
    public function suppReservation(Request $request, $id, ManagerRegistry $registry)
    {
        $reservation = $registry->getRepository(Reservation::class)->find($id);

        $entityManager = $registry->getManager();
        $entityManager->remove($reservation);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('liste_reservation');
    }

    

    // src/Controller/ReservationController.php




    /**
     * @Route("/reservations", name="reservations_list")
     */
    
    /*public function reservationsList(Request $request, ManagerRegistry $registry, ReservationRepository $reservationRepository): Response
    {   $reservationCounts = $reservationRepository->getReservationCounts();
   
        $repository = $this->$registry->getRepository(Reservation::class);
        $reservations = $repository->findAll();

        // Get the count of reservations for each date
        $reservationCounts = $repository->getReservationCounts();

        return  $this->render('reservation/index.html.twig', ['form' => $form->createView(), 'reservations' => $reservations, 'reservationCounts' => $reservationCounts]);

        
    }*/
}


