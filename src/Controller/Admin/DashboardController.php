<?php

namespace App\Controller\Admin;


use App\Entity\Dog;
use App\Entity\Race;
use App\Entity\Adopting;
use App\Entity\Marketer;
use App\Entity\TypeMarketer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ToutouYouToo Admin Zone');
    }

    public function configureMenuItems(): iterable
    {


        yield MenuItem::linkToCrud('Adoptant', 'fas fa-user', Adopting::class);
        yield MenuItem::linkToCrud('Annonceur', 'fas fa-user', Marketer::class);
        yield MenuItem::linkToCrud('Type d\'annonceur', 'fas fa-user', TypeMarketer::class);
        yield MenuItem::linkToCrud('Dog', 'fas fa-dog', Dog::class);
        yield MenuItem::linkToCrud('Race', 'fas fa-dog', Race::class);

    }
}
