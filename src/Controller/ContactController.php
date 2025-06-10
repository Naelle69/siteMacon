<?php

// src/Controller/ContactController.php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance de l'entité Contact
        $contact = new Contact();

        // Création du formulaire
        $form = $this->createForm(ContactTypeForm::class, $contact);

        // Traitement de la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persister et sauvegarder en base
            $entityManager->persist($contact);
            $entityManager->flush();

            // Redirection ou message de confirmation
            $this->addFlash('success', 'Merci pour votre message ! Nous vous répondrons bientôt.');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}