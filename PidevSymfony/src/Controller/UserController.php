<?php

namespace App\Controller;
use App\Entity\Membre;
use App\Entity\Agent;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\AgentRepository;
use App\Repository\MembreRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    

    #[Route('/admin', name: 'app_admin_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/indexAdmin.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/membre', name: 'app_membre_index', methods: ['GET'])]
    public function index2(MembreRepository $membreRepository): Response
    {
        return $this->render('user/indexMembre.html.twig', [
            'membres' => $membreRepository->findAll(),
        ]);
    }

    #[Route('/agent', name: 'app_agent_index', methods: ['GET'])]
    public function index3(AgentRepository $agentRepository): Response
    {
        return $this->render('user/indexAgent.html.twig', [
            'agents' => $agentRepository->findAll(),
        ]);
    }

    


   /* #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }*/
    #[Route('/membre/{id}', name: 'app_membre_show', methods: ['GET'])]
    public function show2(Membre $membre): Response
    {
        return $this->render('user/showmembre.html.twig', [
            'membre' => $membre,
        ]);
    }
    #[Route('/agent/{id}', name: 'app_agent_show', methods: ['GET'])]
    public function show3(Agent $agent): Response
    {
        return $this->render('user/showagent.html.twig', [
            'agent' => $agent,
        ]);
    }

    /*#[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
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
    }*/
    #[Route('/{id}/edit1', name: 'app_membre_edit', methods: ['GET', 'POST'])]
    public function edit2(Request $request, membre $membre, MembreRepository $membreRepository): Response
    {
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $membre->setPassword($this->passwordEncoder->encodePassword($membre, $membre->getPassword()));
            $membreRepository->save($membre, true);

            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/editmembre.html.twig', [
            'membre' => $membre,
            'form' => $form,
        ]);
    }
    #[Route('/{id}/edit2', name: 'app_agent_edit', methods: ['GET', 'POST'])]
    public function edit3(Request $request, agent $agent, AgentRepository $agentRepository): Response
    {
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agent->setPassword($this->passwordEncoder->encodePassword($agent, $agent->getPassword()));
            $agentRepository->save($agent, true);

            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/editagent.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

   /* #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    }*/
    #[Route('/delete/{id}', name: 'app_membre_delete', methods: ['POST'])]
    public function delete2(Request $request, Membre $membre, MembreRepository $membreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membre->getId(), $request->request->get('_token'))) {
            $membreRepository->remove($membre, true);
        }

        return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('delete2/{id}', name: 'app_agent_delete', methods: ['POST'])]
    public function delete3(Request $request, Agent $agent, AgentRepository $agentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agent->getId(), $request->request->get('_token'))) {
            $agentRepository->remove($agent, true);
        }

        return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
