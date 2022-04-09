<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $resa = new Reservation();

        $form = $this->createForm(ReservationType::class, $resa);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

          if($resa->getRoom()) {
              $resa = $form->getData();
              $entityManager->persist($resa);
              $entityManager->flush();
          }

        }
        return $this->render('reservation/index.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }
}
