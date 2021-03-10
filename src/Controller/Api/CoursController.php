<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CoursRepository;
use App\Entity\Cours;
/**
 * @Route("/api/cours", name="api_cours_")
 */
class CoursController extends AbstractController
{
    /**
     * @Route("", name="index", methods={"GET"})
     */
    public function index(CoursRepository $repository): JsonResponse
    {
        $cours = $repository->findAll();
        return $this->json($cours,200);
    }
    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Cours $cours = null): JsonResponse
    {
      if (is_null($cours)){
        return $this->json([
          'message' => 'Tu ne le sais pas encore, mais ce cours est déjà mort',
          'illustration' => 'https://media.tenor.com/images/ab89c542710a01a2f8467952b76945c6/tenor.gif',
        ], 404);
      }

      return $this->json($cours,200);
    }

    /**
     * @Route("/date/{date}", name="getCoursByDay", methods={"GET"})
     */
    public function getCoursByDay(CoursRepository $repository, string $date) : JsonResponse
    {
      $cours = $repository->findBy(
        ['date' => $date],
        ['dateHeureDebut' => 'ASC']
      );

      return $this->json([
        'date' => $date,
        'cours' => $cours,
      ],200);


    }

}
