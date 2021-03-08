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
        return $this->json($cours);
    }
    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(CoursRepository $repository): JsonResponse
    {
    }

}
