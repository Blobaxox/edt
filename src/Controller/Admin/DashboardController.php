<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Professeur;
use App\Entity\Avis;
use App\Entity\Matiere;

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
            ->setTitle('Emploi du temps');
    }

    public function configureMenuItems(): iterable
    {
      return [
        MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
        MenuItem::linktoCrud('Professeur', 'fas fa-chalkboard-teacher', Professeur::class),
        MenuItem::linktoCrud('Matiere', 'fas fa-book-open', Matiere::class),
        MenuItem::linktoCrud('Avis', 'fas fa-star', Avis::class),
      ];
    }
}
