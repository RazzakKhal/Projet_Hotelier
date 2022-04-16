<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $notif = null;
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $name = $data->getName();
            $firstname = $data->getFirstname();
            $mail = $data->getMail();
            $nameos = $name . ' ' . $firstname . ' ' . $mail;

            $object = $data->getObject();
            $subject = $data->getSubject();

            $email = (new Email())
                ->from(new Address($mail, $nameos))
                ->to("khalfallah.razzak@gmail.com")
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                ->replyTo($mail)
                ->subject($subject)
                ->text($object)
                ;

            $mailer->send($email);

            $notif = "votre message à bien été envoyé";
        }


        return $this->render('contact/index.html.twig', [
            'formulaire' => $form->createView(),
            'notif' => $notif
        ]);
    }
}
