<?php

namespace App\Controller;

use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    private $repository;
    public const LAST_EMAIL='app_login_form_old_email';

    /**
     * SecurityController constructor.
     * @param $repository
     */
    public function __construct(ParticipantRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/registrer", name="app_registrer", methods={"GET", "POST"})
     */
    public function registrer(): Response
    {

        return $this->render('security/registrer.html.twig');
    }
    /**
     * @Route("/AjouterUser", name="userAdd",methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws NotFoundHttpException
     */
    public function Add(Request $request): Response
    {
        // recuperation des donner json ;
        //dd($request->getContent());
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $email=$_POST['email'];
        $password=$_POST['password'];





        $this->repository->saveUser($firstName,$lastName,$email,$password) ;
        return $this->redirectToRoute('app_login');


    }
    /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout()
    {
        throw new \LogicException('This mod can be blank - it will be intercepted by the logout key on your firewall');
    }
}
