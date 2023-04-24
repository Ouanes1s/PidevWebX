<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserType2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Swift_Mailer;
use Swift_Message;

class RegistrationController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    #[Route('/registration1', name: 'app_registration1')]
    //coté client
    public function registration1(Request $request , Swift_Mailer $mailer)
    {
        $user = new User();

        $form = $this->createForm(UserType2::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // Set their role
            //$user->setRoles(['ROLE_USER']);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
 //BUNDLE MAILER
 $message = (new Swift_Message('MyCinema Votre compte a été créer avec succés'))
 ->setFrom('mohamedouanes.chebil@esprit.tn')
 ->setTo($user->getEmail())
 ->setBody("<p> Bonjour cher utilisateur </p> <br> Merci de votre inscription vous pouvez maintenant vous authentifier en 
 toute securité en utilisiant vos identifiants !
 En cas de probléme vous pourrez toujours contacter cet email ou les service de reclamation directement via notre site ","text/html");

//send mail
$mailer->send($message);
$this->addFlash('message','Veuillez checkez votre boite mail !');
//    return $this->redirectToRoute("app_login");
            return $this->redirectToRoute('app_login');
              
        }
     


        return $this->render('user/new1.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }

    #[Route('/registration2', name: 'app_registration2')]
    //coté admin
    public function registration2(Request $request, Swift_Mailer $mailer)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // Set their role
            //$user->setRoles(['ROLE_USER']);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
 //BUNDLE MAILER
 $message = (new Swift_Message('MyCinema Votre compte a été créer avec succés par l4amdon'))
 ->setFrom('mohamedouanes.chebil@esprit.tn')
 ->setTo($user->getEmail())
 ->setBody("<p> Bonjour cher Agent </p> <br> Merci de votre inscription vous pouvez maintenant vous authentifier en 
 toute securité en utilisiant vos identifiants !
 Contactez cet email ","text/html");
 
 //send mail
 $mailer->send($message);
 $this->addFlash('message','Veuillez checkez votre boite mail !');
 //    return $this->redirectToRoute("app_login");
            return $this->redirectToRoute('app_admin_index');
        }

        return $this->render('user/new2.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }
}
