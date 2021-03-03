<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\ProfesseurRepository;
use App\Entity\Professeur;

/**
 * @Route("/api/professeur", name="api_professeur_")
 */
class ProfesseurController extends AbstractController
{
    /**
     * @Route("", name="index", methods={"GET"})
     */
    public function index(ProfesseurRepository $repository): JsonResponse
    {
      $professeurs =$repository->findAll();


      // Methode 1 : construction de la réponse
      /*
      $response = new Response;
      $response->setContent(json_encode($professeurs));
      $response->setStatusCode(200);
      $response->headers->set('Content-Type','application/json');
      return response;
      */
      // Methode 2 : Symfony
      return $this->json($professeurs);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id,ProfesseurRepository $repository): JsonResponse
    {
      $professeur =$repository->find($id);

      if (is_null($professeur)){
        return $this->json([
          'message' => 'Ce professeur à disparu, RIP',
        ], 404);
      }

      return $this->json($professeur);
    }

    /**
     * @Route("/{id}/avis", name="avis", methods={"GET"})
     */
    public function indexAvis(int $id,ProfesseurRepository $repository): JsonResponse
    {
      $professeur =$repository->find($id);

      if (is_null($professeur)){
        return $this->json([
          'message' => 'Ce professeur à disparu, RIP',
        ], 404);
      }
      return $this->json($professeur->getAvis()->toArray());
    }
}
