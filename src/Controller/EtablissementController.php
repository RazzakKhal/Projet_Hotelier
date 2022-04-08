<?php

namespace App\Controller;

use App\Repository\EtablissementRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{
    private $etablissementRepository;


    public function __construct(EtablissementRepository $etablissementRepository){
$this->etablissementRepository = $etablissementRepository;

    }

    #[Route('/etablissement-paris', name: 'app_etablissement-paris')]
    public function paris(): Response
    {
        $etablissement = $this->etablissementRepository->findOneBy([
            'City' => 'Paris'
        ]);

        $suites = $etablissement->getRoom();

        return $this->render('etablissement/paris.html.twig', [
            'etablissement' => $etablissement,
            'suites' => $suites

        ]);
    }

    #[Route('/etablissement-marseille', name: 'app_etablissement-marseille')]
    public function marseille(): Response
    {
        $etablissement = $this->etablissementRepository->findOneBy([
            'City' => 'Marseille'
        ]);

        $suites = $etablissement->getRoom();
        return $this->render('etablissement/marseille.html.twig', [
            'etablissement' => $etablissement,
            'suites' => $suites
        ]);
    }

    #[Route('/etablissement-toulouse', name: 'app_etablissement-toulouse')]
    public function toulouse(): Response
    {
        $etablissement = $this->etablissementRepository->findOneBy([
            'City' => 'Toulouse'
        ]);
        $suites = $etablissement->getRoom();
        return $this->render('etablissement/toulouse.html.twig', [
            'etablissement' => $etablissement,
            'suites' => $suites
        ]);
    }

    #[Route('/etablissement-bordeaux', name: 'app_etablissement-bordeaux')]
    public function bordeaux(): Response
    {
        $etablissement = $this->etablissementRepository->findOneBy([
            'City' => 'Bordeaux'
        ]);
        $suites = $etablissement->getRoom();
        return $this->render('etablissement/bordeaux.html.twig', [
            'etablissement' => $etablissement,
            'suites' => $suites
        ]);
    }

    #[Route('/etablissement-nimes', name: 'app_etablissement-nimes')]
    public function nimes(): Response
    {
        $etablissement = $this->etablissementRepository->findOneBy([
            'City' => 'Nimes'
        ]);
        $suites = $etablissement->getRoom();
        return $this->render('etablissement/nimes.html.twig', [
            'etablissement' => $etablissement,
            'suites' => $suites
        ]);
    }

    #[Route('/etablissement-lyon', name: 'app_etablissement-lyon')]
    public function lyon(): Response
    {
        $etablissement = $this->etablissementRepository->findOneBy([
            'City' => 'Lyon'
        ]);
        $suites = $etablissement->getRoom();
        return $this->render('etablissement/lyon.html.twig', [
            'etablissement' => $etablissement,
            'suites' => $suites
        ]);
    }

    #[Route('/etablissement-reims', name: 'app_etablissement-reims')]
    public function reims(): Response
    {
        $etablissement = $this->etablissementRepository->findOneBy([
            'City' => 'Reims'
        ]);
        $suites = $etablissement->getRoom();
        return $this->render('etablissement/reims.html.twig', [
            'etablissement' => $etablissement,
            'suites' => $suites
        ]);
    }

}
