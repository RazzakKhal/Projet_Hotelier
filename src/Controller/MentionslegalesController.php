<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionslegalesController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_mentionslegales')]
    public function index(): Response
    {
        return $this->render('mentionslegales/index.html.twig');
    }
}
