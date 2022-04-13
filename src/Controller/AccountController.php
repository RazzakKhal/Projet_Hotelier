<?php

namespace App\Controller;


use App\Form\UpdatePasswordType;
use App\Repository\ReservationRepository;
use App\Repository\RoomRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class AccountController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct($entityManager)
    {
        return $this->entityManager = $entityManager;
    }

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
    public function suppResaClient(ReservationRepository $reservationRepository, $idresa){
 $reservation = $reservationRepository->find($idresa);
 $this->entityManager->remove($reservation);
 $this->entityManager->flush();
        return $this->render('account/reservations.html.twig');
    }


    // fonction qui permet à un manager de supprimer la suite de son choix de son etablissement
    #[Route('compte/supprsuite/{idsuite}', name: 'app_supprsuite')]
    public function suppSuiteManager($idsuite, RoomRepository $roomRepository){

        $suite = $roomRepository->find($idsuite);

            $this->entityManager->remove($suite);

        $this->entityManager->flush();
        return $this->render('account/suppressionsuite.html.twig');
    }




}
