<?php

namespace App\Controller;
use App\Entity\RechercheNom;

use App\Form\RechercheNomType;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/user')]
class UserController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    

    #[Route('/admin', name: 'app_admin_index')]
    // public function index(UserRepository $userRepository): Response
    // {
    //     return $this->render('user/indexAdmin.html.twig', [
    //         'users' => $userRepository->findAll(),
    //     ]);
    // }
    public function index(Request $request, ManagerRegistry $registry,UserRepository $userRepository )
    {
        $rechercher = new RechercheNom();
        $form = $this->createForm(RechercheNomType::class, $rechercher);
        $form->handleRequest($request);
        $users = [];
        $users = $registry->getRepository(User::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $nom_user = $rechercher->getNomUser();
            if ($nom_user != "")
                $users = $registry->getRepository(User::class)->findBy(['nom_user' => $nom_user]);
            else
                $users = $registry->getRepository(User::class)->findAll();
        }
        return  $this->render('user/indexAdmin.html.twig', ['form' => $form->createView(), 'users' => $users]);
    }

    #[Route('/utilisateur', name: 'app_user_index', methods: ['GET'])]
    public function index2(UserRepository $userRepository): Response
    {
        return $this->render('user/indexUser.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /*#[Route('/Reservation', name: 'app_reservation_index', methods: ['GET'])]
    public function index3(UserRepository $userRepository): Response
    {
        return $this->render('user/indexReservation.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }*/
    
    

    #[Route('/agent', name: 'app_agent_index', methods: ['GET'])]
    public function index6(UserRepository $userRepository): Response
    {
        return $this->render('user/indexAgent.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    


    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
