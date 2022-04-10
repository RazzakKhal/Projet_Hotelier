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
 $client = $this->getUser();
        if($form->isSubmitted() && $form->isValid()){
            // je vais vérifier que la date du début de séjour soit bien supérieur à ajd
            $resa = $form->getData();
            $datedebut = $resa->getStart()->getTimestamp();
            $dateajd = time();

          if($resa->getRoom() && $client && $datedebut > $dateajd) {

             $resa->setClient($client);
              $entityManager->persist($resa);
              $entityManager->flush();
              echo "<alert class='alert-dark'>Réservation effectuée</alert>";
          }
          else if($resa->getRoom() && $datedebut > $dateajd){

              echo "<alert class='alert-dark'>Veuillez vous connecter afin de pouvoir réserver</alert>";
          }
          else if($resa->getRoom()){
              echo "<alert class='alert-dark'>Veuillez vérifier que les dates séléctionnées soient bonnes</alert>";
          }
          else{
alert('la resa ne renvoi pas la chambre');
dump($resa);
          }

        }
        return $this->render('reservation/index.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }
}
