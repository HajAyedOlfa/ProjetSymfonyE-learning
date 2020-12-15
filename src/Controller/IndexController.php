<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Form\MatiereType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\MatiereRepository;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     * @IsGranted("ROLE_USER")
     */
    public function index(MatiereRepository $matiereRepository): Response
    {

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'matieres' => $matiereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="matiere_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($matiere);
            $entityManager->flush();

            return $this->redirectToRoute('matiere_index');
        }

        return $this->render('matiere/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="matiere_show", methods={"GET"})
     */
    public function show(Matiere $matiere): Response
    {
        return $this->render('matiere/show.html.twig', [
            'matiere' => $matiere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="matiere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Matiere $matiere): Response
    {
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('matiere_index');
        }

        return $this->render('matiere/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="matiere_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Matiere $matiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($matiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index');
    }









}
