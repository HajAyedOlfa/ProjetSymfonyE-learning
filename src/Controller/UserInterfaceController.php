<?php

namespace App\Controller;

use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user_")
 */
class UserInterfaceController extends AbstractController
{
    /**
     * @Route("/interface", name="interface")
     */
    public function index(MatiereRepository $matiereRepository): Response
    {
        return $this->render('user_interface/index.html.twig', [
            'controller_name' => 'UserInterfaceController',
            'matieres' => $matiereRepository->findAll(),
        ]);
    }
    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function  add($id, SessionInterface $session) {

        $panier = $session->get('panier', []);

        $panier[$id] =1;

        $session->set('panier', $panier);

        return $this->redirectToRoute("user_panier");

    }
    /**
     * @Route("/panier", name="panier")
     */
    public function panier(SessionInterface $session, MatiereRepository $matiereRepository)
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach ($panier as $id => $quantity ){
            $panierWithData[] = [
                'matiere' => $matiereRepository->find($id),

            ];
        }
        $total = 0;
        foreach ($panierWithData as $item){
            $totalItem = $item['matiere']->getPrixMat();
            $total += $totalItem;
        }
        return $this->render('user_interface/panier.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }
    /**
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, SessionInterface $session){
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("user_panier");
    }
}
