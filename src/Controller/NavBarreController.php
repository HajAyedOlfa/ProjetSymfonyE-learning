<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavBarreController extends AbstractController
{
    /**
     * @Route("/nav/barre", name="nav_barre")
     */
    public function index(): Response
    {
        return $this->render('nav_barre/index.html.twig', [
            'controller_name' => 'NavBarreController',
        ]);
    }
}
