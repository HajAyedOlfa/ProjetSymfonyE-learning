<?php

namespace App\Service;

use App\Repository\MatiereRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class panier_service
{

    protected $session;
    protected $matiereRepository;

    /**
     * panierService constructor.
     */
    public function __construct(SessionInterface $session, MatiereRepository $matiereRepository)
    {
        $this->session = $session;
        $this->matiereRepository = $matiereRepository;
    }

    public function add(int $id)
    {

        $panier = $this->session->get('panier', []);

        $panier[$id] = 1;

        $this->session->set('panier', $panier);
        // dd($session->get('panier'));
    }

    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
    }

    public function getFullPanier(): array
    {
        $panier = $this->session->get('panier', []);
        $panierWithData = [];
        foreach ($panier as $id => $quantity) {
            $panierWithData[] = ['matiere' => $this->matiereRepository->find($id)];
        }
        return $panierWithData;
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getFullPanier() as $item) {
            $total += $item['matiere']->getPrixMat();
        }
        return $total;
    }


}
