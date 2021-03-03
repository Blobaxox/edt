<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProfesseurRepository;
use App\Entity\Professeur;
use App\Entity\Avis;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function show(Professeur $professeur = null): JsonResponse
    {
      if (is_null($professeur)){
        return $this->json([
          'message' => 'Tu ne le sais pas encore, mais ce professeur est déjà mort',
          'illustration' => 'https://media.tenor.com/images/ab89c542710a01a2f8467952b76945c6/tenor.gif',
        ], 404);
      }

      return $this->json($professeur);
    }

    /**
     * @Route("/{id}/avis", name="avis", methods={"GET"})
     */
    public function indexAvis(Professeur $professeur = null): JsonResponse
    {
      if (is_null($professeur)){
        return $this->json([
          'message' => 'Tu ne le sais pas encore, mais ce professeur est déjà mort',
          'illustration' => 'https://media.tenor.com/images/ab89c542710a01a2f8467952b76945c6/tenor.gif',
        ], 404);
      }
      return $this->json($professeur->getAvis()->toArray());
    }

    /**
     * @Route("/{id}/avis", name="create_avis", methods={"POST"})
     */
    public function createAvis(Request $request,Professeur $professeur = null, ValidatorInterface $validator,EntityManagerInterface $em): JsonResponse
    {
      if (is_null($professeur)){
        return $this->json([
          'message' => 'Tu ne le sais pas encore, mais ce professeur est déjà mort',
          'illustration' => 'https://media.tenor.com/images/ab89c542710a01a2f8467952b76945c6/tenor.gif',
        ], 404);
      }

      $data = json_decode($request->getContent(),true);
      $data['professeur'] = $professeur;
      $avis = new Avis($data);

      $errors = $validator->validate($avis);

      if($errors->count() > 0){
        return $this->json($this->formatErrors($errors),400);
      }
      $em->persist($avis);
      $em->flush();

      return $this->json($avis,201);
    }

    /**
     * @Route("/avis/{id}", name="delete_avis", methods={"DELETE"})
     */
    public function deleteAvis(Avis $avis = null,EntityManagerInterface $em): JsonResponse
    {
      if (is_null($avis)){
        return $this->json([
          'message' => 'Tu ne le sais pas encore, mais cet avis est déjà mort',
          'illustration' => 'https://media.tenor.com/images/ab89c542710a01a2f8467952b76945c6/tenor.gif',
          ], 404);
      }
      $em->remove($avis);
      $em->flush();

      return $this->json(null,204);
    }

    protected function formatErrors($errors)
    {
      $message = [];
      foreach ($errors as $key => $error) {
        $message[$error->getPropertyPath()] = $error->getMessage();
      }
      return $message;
    }
}
