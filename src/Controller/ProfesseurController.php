<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProfesseurRepository;
use App\Entity\Professeur;
use App\Form\ProfesseurType;

/**
 * @Route("/professeurs", name="professeurs_")
 */
class ProfesseurController extends AbstractController
{
    /**
     * @Route("", name="index", methods={"GET"})
     */
    public function index(ProfesseurRepository $repository): Response
    {
      $professeurs = $repository->findAll();

      return $this->render('professeur/index.html.twig',[
        'professeurs' => $professeurs,
     ]);
    }
    /**
     * @Route("/create", name="create", methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {
      $professeur= new Professeur;
      $form = $this->createForm(ProfesseurType::class,$professeur);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $professeur = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($professeur);
        $em->flush();
      }

      return $this->render('professeur/create.html.twig',[
        'form' => $form->createView(),
     ]);
    }
    /**
     * @Route("/update", name="update", methods={"GET", "POST"})
     */
    public function update()
    {

    }
    /**
     * @Route("/delete", name="delete", methods={"GET"})
     */
    public function delete()
    {

    }
}
