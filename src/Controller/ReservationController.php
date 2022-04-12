<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

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
             $client->addReservation($resa);
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

          }

        }
        return $this->render('reservation/index.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }


    // fonction qui me permet de recupérer mes dates lorsque je requete l'url reservation/resa

    #[Route('/reservation/resa', name: 'app_resa')]
    public function resa(EntityManagerInterface $entityManager, ReservationRepository $reservationRepository, NormalizerInterface $normalizer ){
$reservations = $reservationRepository->findAll();
$dates = $normalizer->normalize($reservations, null, ['groups' => 'post:read']);



        return $this->json($dates, 200);
}
}
