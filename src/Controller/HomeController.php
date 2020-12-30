<?php

namespace App\Controller;

use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(MatiereRepository $matiereRepository)
    {
        return $this->render('home.html.twig',[
            'matieres' => $matiereRepository->findAll(),
        ]);
    }

}
