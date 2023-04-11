<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\RechercheBlog;

use App\Form\BlogType;
use App\Form\RechercheBlogType;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;




class BlogController extends AbstractController
{
    #[Route('/blog/liste', name: 'liste_blog')]
    public function index(Request $request, ManagerRegistry $registry): Response
    {
        $rechercher = new RechercheBlog();
        $form = $this->createForm(RechercheBlogType::class, $rechercher);
        $form->handleRequest($request);

        $blogs = [];
        $blogs = $registry->getRepository(Blog::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $email_blg = $rechercher->getEmailBlg();
            if ($email_blg != "")
                $blogs = $registry->getRepository(Blog::class)->findBy(['email_blg' => $email_blg]);
            else
                $blogs = $registry->getRepository(Blog::class)->findAll();
        }
        return  $this->render('blog/index.html.twig', ['form' => $form->createView(), 'blogs' => $blogs]);
    }

    #[Route('/blog/ajout', name: 'ajout_blog')]
    public function ajoutBlog(Request $request, ManagerRegistry $Registry)
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        $entitymanager = $Registry->getManager();
        if ($form->isSubmitted()) {
            $entitymanager->persist($blog);
            $entitymanager->flush();
            return $this->redirectToRoute('ajout_blog');
        }
        return $this->render('blog/ajoutBlog.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/blog/details/{id}', name: 'details_blog')]
    public function detailsBlog($id, ManagerRegistry $registry): Response
    {
        $blog = $registry->getRepository(Blog::class)->find($id);
        return $this->render('blog/detailsBlog.html.twig', array('blog' => $blog));
    }

    #[Route('/blog/modif/{id}', name: 'modif_blog')]
    public function modifBlog(Request $request, $id, ManagerRegistry $registry)
    {
        $blog = new Blog();
        $blog = $registry->getRepository(Blog::class)->find($id);

        $form = $this->createForm(BlogType::class, $blog);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $registry->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_blog');
        }

        return $this->render('blog/modifBlog.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/blog/supp/{id}', name: 'supp_offre')]
    public function suppBlog(Request $request, $id, ManagerRegistry $registry)
    {
        $blog = $registry->getRepository(Blog::class)->find($id);

        $entityManager = $registry->getManager();
        $entityManager->remove($blog);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('liste_blog');
    }
}
