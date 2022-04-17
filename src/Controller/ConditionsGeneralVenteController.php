<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConditionsGeneralVenteController extends AbstractController
{
    #[Route('/conditions/general/vente', name: 'app_conditions_general_vente')]
    public function index(): Response
    {
        return $this->render('conditions_general_vente/index.html.twig');
    }
}
