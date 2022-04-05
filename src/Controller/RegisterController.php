<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $ManagerEn, UserPasswordHasherInterface $hasherpass): Response
    {
        $user = new User();
        $formulaire = $this->createForm(RegisterType::class ,$user); #Je met en paramètre mon formulaire précédemment créer et l'instance qui correspond à l'entité liée
        $formulaire->handleRequest($request); # je permet à mon formulaire d'écouter la requête

        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $user = $formulaire->getData(); #si formulaire est envoyé et est valide alors je transmet ses infos à user
$clearpassword =$user->getPassword();
$hashedpassword = $hasherpass->hashPassword($user, $clearpassword);
$user->setPassword($hashedpassword);



           $ManagerEn->persist($user); # j'utilise l'entity manager pour figer l'objet user
           $ManagerEn->flush(); # j'utilise l'entity manager pour envoyer en bdd les infos
        }

        return $this->render('register/index.html.twig',[
            'formulaire' => $formulaire->createView() #Je met en forme mon formulaire
            ]
        );
    }
}
