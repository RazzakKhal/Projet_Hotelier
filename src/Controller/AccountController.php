<?php

namespace App\Controller;


use App\Form\ManagerEtablissementType;
use App\Form\UpdatePasswordType;
use App\Repository\EtablissementRepository;
use App\Repository\ReservationRepository;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class AccountController extends AbstractController
{


    #[Route('/compte', name: 'app_account')]
    public function index(): Response
    {
$user = $this->getUser();
$reservations = $user->getReservations();
$resa = null;
$nometablissement = null;
// récupération de l'etablissement du gérant
if($user->getEtablissement()){
    $etablissement = $user->getEtablissement();
    $suites = $etablissement->getRoom();

}


// récupération des réservations de l'utilisateur si il en a
        if($reservations){
foreach($reservations as $reservation){
    $resa[] = $reservation;
}}

        return $this->render('account/index.html.twig', [
            'reservation' => $resa,
            'user' => $user,
            'suites' => $suites
        ]);
    }

    #[Route('/compte/modification-mot-de-passe', name : 'app_modifpass')]
    public function modifPass(Request $request,UserPasswordHasherInterface $hasher ,EntityManagerInterface $entityManager) : Response
    {
        $notification = null;
        $user = $this->getUser();
        $form = $this->createForm(UpdatePasswordType::class, $user);

        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){
            $oldpass = $form->get('old_password')->getData();
if($hasher->isPasswordValid($user, $oldpass)){
    $newpass = $hasher->hashPassword($user, $form->get('new_password')->getData());
    $user->setPassword($newpass);
    $entityManager->flush();
    $notification = 'Modification du mot de passe réussie';
}else{
    $notification = 'Le mot de passe ne correspond pas';
}

        }


        return $this->render('account/password.html.twig', [
            'formulaire' => $form->createView(),
            'notification' => $notification
        ]);

    }




    #[Route('/compte/suppresa/{idresa}', name: 'app_suppresa')]
    public function suppResaClient(EntityManagerInterface $entityManager ,ReservationRepository $reservationRepository, $idresa){
 $reservation = $reservationRepository->find($idresa);
 $entityManager->remove($reservation);
 $entityManager->flush();
        return $this->render('account/reservations.html.twig');
    }


    // fonction qui permet à un manager de supprimer la suite de son choix de son etablissement
    #[Route('/compte/supprsuite/{idsuite}', name: 'app_supprsuite')]
    public function suppSuiteManager($idsuite, RoomRepository $roomRepository, EntityManagerInterface $entityManager){
//recuperer la suite de l'etablissement
        $suite = $roomRepository->find($idsuite);
        $etablissement = $this->getUser()->getEtablissement();
        $etablissement->removeRoom($suite);

        $entityManager->flush();
        return $this->render('account/suppressionsuite.html.twig');
    }

#[Route('/compte/ajoutsuite', name: 'app_ajoutsuite')]
public function ajoutSuiteManager(){

        $etablissement = $this->getUser()->getEtablissement();
$form = $this->createForm(ManagerEtablissementType::class, $etablissement);

        return $this->render('account/ajoutsuite.html.twig', [
            'formulaire' => $form->createView()
        ]);
}

}
