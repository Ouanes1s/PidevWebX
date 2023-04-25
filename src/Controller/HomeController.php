<?php

namespace App\Controller;


use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\RechercheProduit_Nom;
use App\Form\ProduitType;
use App\Form\CategorieType;
use App\Form\RechercheProdNomType;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class HomeController extends AbstractController
{
    //back
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/front', name: 'front')]
    public function front(): Response
    {
        return $this->render('front.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/front/nourri', name: 'nourri')]
    public function nourriture(ManagerRegistry $registry): Response
    {
        $categories = $registry->getRepository(Categorie::class)->findAll();

        return $this->render('front/categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/front/categorie/{id}', name: 'front_categorie_produits')]
    public function categorieProduits(Categorie $categorie): Response
    {
        $produits = $categorie->getProduits();

        return $this->render('front/produits.html.twig', [
            'produits' => $produits,
        ]);
    }


    #[Route('/front/produit/details/{id}', name: 'front_produit_details')]
    public function detailsProduit($id, ManagerRegistry $registry): Response
    {
        $produit = $registry->getRepository(Produit::class)->find($id);

        return $this->render('front/detailsProduit.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/front/produitenPromo', name: 'front_produitenPromo')]
    public function produitsEnPromo(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager->getRepository(Produit::class)
            ->createQueryBuilder('p')
            ->where('p.Offre IS NOT NULL')
            ->getQuery()
            ->getResult();

        return $this->render('front/produits.html.twig', ['produits' => $produits]);
    }



    /*
    #[Route('/produit/mail', name: 'mail')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('meryam.saidi@esprit.tn')
            ->to('meryam.saidi@esprit.tn')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Venez découvrir nos produits en promos !')
            //->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        return new Response('Email sent successfully');
        // ...
    }
*/


    #[Route('/produit/mail', name: 'mail')]
    public function sendggEmail(MailerService $mailer): Response
    {
        $mailer->sendEmail($to = 'meryam.saidi@esprit.tn', $content = '<p>See Twig integration for better HTML integration!</p>', $subject = 'Venez découvrir nos produits en promos !');
        return new Response('Email sent successfully');
    }
}
