<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use App\Entity\Contact;
use App\Entity\DomainesExpertise;
use App\Entity\Service;
use App\Entity\User;
use App\Entity\Chantiers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
/* use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator; */
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]

    public function index(): Response
    {
      
       return $this->render('admin/index.html.twig');
    }

        /* ou public function index(): Response
    {
        $url = $this->container->get(AdminUrlGenerator::class)
            ->setController(ServiceCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    } */

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
            /* ->setTranslationDomaine('messages');
            ->set */
    }

    public function configureMenuItems(): iterable
{
    yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');

    yield MenuItem::section('Gestion des utilisateurs');
    yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);

    yield MenuItem::section('Contenu du site');
    yield MenuItem::linkToCrud('Domaines d\'expertise', 'fa fa-briefcase', DomainesExpertise::class);
    yield MenuItem::linkToCrud('Services', 'fa fa-cogs', Service::class);
    yield MenuItem::linkToCrud('Chantiers', 'fa fa-tools', Chantiers::class);

    yield MenuItem::section('Retours & Contact');
    yield MenuItem::linkToCrud('Avis clients', 'fa fa-comment', Avis::class);
    yield MenuItem::linkToCrud('Messages de contact', 'fa fa-envelope', Contact::class);

    yield MenuItem::section();
    yield MenuItem::linkToUrl('Revenir au site', 'fa fa-globe', $this->generateUrl('app_home'));
}
}

/* if ($this->isGranted('ROLE_ADMIN')) {
    yield MenuItem::section('Administration avancée');
    // ...
} */