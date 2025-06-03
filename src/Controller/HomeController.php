<?php

namespace App\Controller;

use App\Repository\HeaderRepository;
use App\Repository\DomainesExpertiseRepository;
use App\Repository\ChantiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('', name: 'app_home')]
    public function index(
        HeaderRepository $headerRepository,
        DomainesExpertiseRepository $domainesRepo,
        ChantiersRepository $chantiersRepo
    ): Response {
        // Récupère un seul header (par exemple avec l'id 3)
        $header = $headerRepository->find(3);

        // Récupère tous les domaines d'expertise
        $domaines = $domainesRepo->findAll();

        // Récupère tous les chantiers
        $chantiers = $chantiersRepo->findAll();

        return $this->render('home/index.html.twig', [
            'header' => $header,
            'domaines' => $domaines,
            'chantiers' => $chantiers,
        ]);
    }
}