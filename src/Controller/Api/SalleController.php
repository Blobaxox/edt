<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SalleRepository;
use App\Entity\Salle;
/**
 * @Route("/api/salles", name="api_salles_")
 */
class SalleController extends AbstractController
{
  /**
   * @Route("", name="index")
   */
    public function index(SalleRepository $repository): Response
    {
        $salle =$repository->findAll();
        return $this->json($salle);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Salle $salle = null): JsonResponse
    {
      if (is_null($salle)){
        return $this->json([
          'message' => 'Tu ne le sais pas encore, mais cette salle est déjà morte',
          'illustration' => 'https://media.tenor.com/images/ab89c542710a01a2f8467952b76945c6/tenor.gif',
        ], 404);
      }

      return $this->json($salle);
    }
}
