<?php

namespace App\Controller\Admin;

use App\Entity\Container;
use App\Entity\ContainerType;
use App\Entity\Feed;
use App\Entity\Observation;
use App\Entity\Plant;
use App\Entity\Seed;
use App\Entity\SeedBrand;
use App\Entity\SeedSource;
use App\Entity\SeedType;
use App\Entity\SeedVariety;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Locale;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(PlantCrudController::class)
            ->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Container', 'fas fa-list', Container::class);
        yield MenuItem::linkToCrud('Container Type', 'fas fa-list', ContainerType::class);
        yield MenuItem::linkToCrud('Feed', 'fas fa-list', Feed::class);
        yield MenuItem::linkToCrud('Observation', 'fas fa-list', Observation::class);
        yield MenuItem::linkToCrud('Plant', 'fas fa-list', Plant::class);
        yield MenuItem::linkToCrud('Seed', 'fas fa-list', Seed::class);
        yield MenuItem::linkToCrud('Seed Brand', 'fas fa-list', SeedBrand::class);
        yield MenuItem::linkToCrud('Seed Source', 'fas fa-list', SeedSource::class);
        yield MenuItem::linkToCrud('Seed Type', 'fas fa-list', SeedType::class);
        yield MenuItem::linkToCrud('Seed Variety', 'fas fa-list', SeedVariety::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
    }
}
