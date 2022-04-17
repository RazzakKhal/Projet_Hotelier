<?php

namespace App\Controller;


use App\Entity\Reservation;
use App\Form\EtabRoomResaType;
use App\Form\ReservationType;
use App\Repository\EtablissementRepository;
use App\Repository\ReservationRepository;
use App\Repository\RoomRepository;
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

        $form = $this->createForm(EtabRoomResaType::class, $resa);
        $form->handleRequest($request);
 $client = $this->getUser();
        if($form->isSubmitted() && $form->isValid()){
            // je vais vérifier que la date du début de séjour soit bien supérieur à ajd
            $resa = $form->getData();
            $datedebut = $resa->getStart()->getTimestamp();
            $dateajd = time();

          if($resa->getRoom() && $client && $datedebut > $dateajd) {

             $resa->setClient($client);
           //inutile  $client->addReservation($resa);
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

    #[Route('/reserv/resa/{etab}/{room}', name: 'app_resa')]
    public function resa($etab, $room, ReservationRepository $reservationRepository, NormalizerInterface $normalizer, EtablissementRepository $etablissementRepository, RoomRepository $roomRepository ){
        $etabi = str_replace('-', ' ', $etab);
$etablissement = $etablissementRepository->findOneBy([
    'Name' => $etabi
]);
$roomi = str_replace('-', ' ', $room);
$suite = $roomRepository->findOneBy([
    'Title' => $roomi
]);
        $reservations = $reservationRepository->findByEtabRoom($etablissement, $suite);
       $dates = $normalizer->normalize($reservations, null, ['groups' => 'post:read']);



        return $this->json($dates, 200);
}


// fonction qui permet d'avoir un formulaire pré-rempli lors du clique sur la page de l'etablissement pour réserver une suite

#[Route('/reservation/{etab}/{room}', name: 'app_resapersonnalise')]
public function resaPerso($etab, $room, Request $request, EtablissementRepository $etablissementRepository, RoomRepository $roomRepository, EntityManagerInterface $entityManager){
    $etabi = str_replace('-', ' ', $etab);
    $roomi = str_replace('-', ' ', $room);
        $resa = new Reservation();
        $etablissement = $etablissementRepository->find($etabi);
        $suite = $roomRepository->find($roomi);
        $resa->setEtablissement($etablissement);
        $resa->setRoom($suite);

    $form = $this->createForm(EtabRoomResaType::class, $resa);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $client = $this->getUser();
        $resa = $form->getData();
        $datedebut = $resa->getStart()->getTimestamp();
        $dateajd = time();

        if($datedebut > $dateajd) {
            $resa->setEtablissement($etablissement); // je remet etab et room car champs disabled
            $resa->setRoom($suite);
            $resa->setClient($client);
            $entityManager->persist($resa);
            $entityManager->flush();
            echo "<alert class='alert-dark'>Réservation effectuée</alert>";
        }
        else {

            echo "<alert class='alert-dark'>Les dates indiquées ne semblent pas corrects</alert>";
        }


    }


        return $this->render('reservation/resaperso.html.twig', [
            'formulaire' => $form->createView()
        ]);
}

}
