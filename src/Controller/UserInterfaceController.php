<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use App\Repository\MatiereRepository;
use App\Repository\ParticipantRepository;
use App\Service\panier_service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/user", name="user_")
 * @IsGranted("ROLE_USER")
 */
class UserInterfaceController extends AbstractController
{
    /**
     * @Route("/interface", name="interface")
     */
    public function index(MatiereRepository $matiereRepository, ParticipantRepository $participantRepository, Session $session): Response
    {
        $user = $participantRepository->findOneByEmail($session->get('app_login_form_old_email'));
        //dd($user->getUser());
        return $this->render('user_interface/index.html.twig', [
            'controller_name' => 'UserInterfaceController',
            'matieres' => $matiereRepository->findAll(),

        ]);
    }
    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function  add($id, panier_service $panier_service) {

        $panier_service->add($id);

        return $this->redirectToRoute("user_panier");

    }
    /**
     * @Route("/panier", name="panier")
     */
    public function panier(panier_service $panier_service)
    {

        return $this->render('user_interface/panier.html.twig', [
            'items' => $panier_service->getFullPanier(),
            'total' => $panier_service->getTotal()
        ]);
    }
    /**
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, panier_service $panier_service){

        $panier_service->remove($id);
        return $this->redirectToRoute("user_panier");
    }


    /**
     * @Route ("/panier/create-checkout" , name="panier_checkout")
     */
    public function checkout(SessionInterface $session, panier_service $panier_service)
    {

        \Stripe\Stripe::setApiKey('sk_test_51I4RvsCPusUtyPPiLyXJK1LcmtzVaCfU1kYvkc3cCPlSqwJjGlZVeSKB6LyLcG8bDTk3fclrVlWupMFbnG4hU6Av00suoVuyS5');
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $panier_service->getTotal()*100,
                    'product_data' => [
                        'name' => 'Votre prix a payer = ',

                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('user_checkout_success',[], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('user_checkout_faild',[], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return new JsonResponse(['id' => $checkout_session->id]);
    }
    /**
     * @Route ("/panier/checkout/success" , name="checkout_success")
     */
    public function succes(panier_service  $panier_service)
    {
        $panier_service->commender();
        return $this->render('user_interface/success.html.twig',[
            'vide' =>$panier_service->removeall()
        ]);

    }
    /**
     * @Route ("/panier/checkout/faild" , name="checkout_faild")
     */
    public function faild( )
    {
        return $this->redirectToRoute("user_panier");
    }



}
