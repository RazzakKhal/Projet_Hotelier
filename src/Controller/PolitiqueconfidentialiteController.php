<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PolitiqueconfidentialiteController extends AbstractController
{
    #[Route('/politique-confidentialité', name: 'app_politiqueconfidentialite')]
    public function index(): Response
    {
        return $this->render('politiqueconfidentialite/index.html.twig');
    }
}
