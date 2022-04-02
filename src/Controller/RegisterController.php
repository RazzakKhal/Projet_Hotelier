<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(): Response
    {
        $user = new User();
        $formulaire = $this->createForm(RegisterType::class ,$user); #Je met en paramètre mon formulaire précédemment créer et l'instance qui correspond à l'entité liée
        return $this->render('register/index.html.twig',[
            'formulaire' => $formulaire->createView() #Je met en forme mon formulaire
            ]
        );
    }
}
