<?php

namespace App\Controller;

use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(MatiereRepository $matiereRepository)
    {
            dd('bnjour');

    }
    /**
     * @Route("/json", name="jsonRes")
     */
    public function res(MatiereRepository $matiereRepository)
    {
        $Matiers=$matiereRepository->findAll();
         $data=[];
         foreach ($Matiers as $matier) {
             $data[] = [
                 'nomMatiere' => $matier->getNomMat(),
                 'prix' => $matier->getPrixMat(),
                 'image' => $matier->getImgMat(),
             ];
         }
        return new JsonResponse($data, 200, array('Access-Control-Allow-Origin'=> '*'));
    }

}
