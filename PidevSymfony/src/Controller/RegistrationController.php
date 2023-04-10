<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Membre;
use App\Entity\User;
use App\Form\AgentType;
use App\Form\MembreType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistrationController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    #[Route('/registration1', name: 'app_registration1')]
    //coté membre
    public function registration1(Request $request)
    {
        $user = new Membre();

        $form = $this->createForm(MembreType::class, $user);

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

            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/new1.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }

    #[Route('/registration2', name: 'app_registration2')]
    //coté agent
    public function registration2(Request $request)
    {
        $user = new Agent();

        $form2 = $this->createForm(AgentType::class, $user);

        $form2->handleRequest($request);

        if ($form2->isSubmitted() && $form2->isValid()) {
            // Encode the new users password
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // Set their role
            //$user->setRoles(['ROLE_USER']);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_agent_index');
        }

        return $this->render('user/new2.html.twig', [
            'form' => $form2->createView(),
            
        ]);
    }
}
