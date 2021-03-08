<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalleController extends AbstractController
{
    /**
     * @Route("/api/salle", name="api_salle")
     */
    public function index(): Response
    {
        return $this->render('api/salle/index.html.twig', [
            'controller_name' => 'SalleController',
        ]);
    }
}
