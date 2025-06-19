<?php

namespace App\Controller;

use App\Repository\HeaderRepository;
use App\Repository\DomainesExpertiseRepository;
use App\Repository\ChantiersRepository;
use App\Repository\AvisRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
#[Route('', name: 'app_home')]
public function index(
    Request $request,
    HeaderRepository $headerRepository,
    DomainesExpertiseRepository $domainesRepo,
    ChantiersRepository $chantiersRepo,
    AvisRepository $avisRepository,
    PaginatorInterface $paginator
): Response {
    // Récupère un seul header (par exemple avec l'id 3)
    $header = $headerRepository->find(1);

    // Récupère tous les domaines d'expertise
    $domaines = $domainesRepo->findAll();

    // Récupère tous les chantiers
    $chantiers = $chantiersRepo->findAll();

    // Récupère les avis avec pagination
    $query = $avisRepository->createQueryBuilder('a')
        ->orderBy('a.id', 'DESC') // ou a.createdAt si tu as un champ de date
        ->getQuery();

    $avisPagines = $paginator->paginate(
        $query,
        $request->query->getInt('page', 1),
        6 // Nombre d'éléments par page
    );

    return $this->render('home/index.html.twig', [
        'header' => $header,
        'domaines' => $domaines,
        'chantiers' => $chantiers,
        'avisList' => $avisPagines,
    ]);
}
}