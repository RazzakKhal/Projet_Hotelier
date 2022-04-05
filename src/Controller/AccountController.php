<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdatePasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(): Response
    {


        return $this->render('account/index.html.twig');
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
}
