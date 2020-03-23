<?php

namespace App\Controller;

use App\Form\ContactType;
use phpDocumentor\Reflection\Types\Context;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $contactFormData = $form->getData();


            $form = $this->createForm(ContactType::class);

            $message = (new \Swift_Message('New e-mail :)'))
                ->setFrom($contactFormData['from'])
                ->setTo('emai@email.com')
                ->setCC($contactFormData['from'])
                ->setBody(
                    $contactFormData['message'],
                    'text/plain'
                );
            $mailer->send($message);

            $this->addFlash('yay', 'Contact email verzonden');

            return $this->redirectToRoute('contact');


        }
        return $this->render('contact/contact.html.twig', [
            'contact_form' => $form->createView()
        ]);
    }
}
