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
        //$reponse = new JsonResponse();
        //$datas=$matiereRepository->findAll();
//
        //foreach ($datas as $data => $id){
        //    $reponse->setData("json_encode($id->nomMat, $id->prixMat, $id->imgMat");
        //    //$reponse->setData("json_encode($id->prixMat");
        //    //$reponse->setData("json_encode($id->imgMat");
//
        //}
        //return $this->redirect('http://localhost:4200/', [
        //    'matieres' => $reponse
        //]);

        return $this->render('home.html.twig',[
            'matieres' => $matiereRepository->findAll(),
        ]);
    }

}
