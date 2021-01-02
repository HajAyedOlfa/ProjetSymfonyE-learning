<?php

namespace App\Controller;

use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/participant", name="participant")
     */
    public function index(ParticipantRepository $participantRepository): Response
    {

        return $this->render('participant/index.html.twig', [
            'controller_name' => 'ParticipantController',
            'users'=>$participantRepository->findAll()
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function showAdmin(ParticipantRepository $participantRepository): Response
    {
        return $this->render('participant/admin.html.twig', [
            'controller_name' => 'ParticipantController',
            'users'=>$participantRepository->findAll()
        ]);
    }
}
