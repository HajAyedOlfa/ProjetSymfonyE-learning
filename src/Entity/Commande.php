<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Participant::class, inversedBy="user")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Matiere::class, inversedBy="commandes")
     */
    private $matiereCom;

    public function __construct()
    {
        $this->matiereCom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Participant
    {
        return $this->user;
    }

    public function setUser(?Participant $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatiereCom(): Collection
    {
        return $this->matiereCom;
    }

    public function addMatiereCom(Matiere $matiereCom): self
    {
        if (!$this->matiereCom->contains($matiereCom)) {
            $this->matiereCom[] = $matiereCom;
        }

        return $this;
    }

    public function removeMatiereCom(Matiere $matiereCom): self
    {
        $this->matiereCom->removeElement($matiereCom);

        return $this;
    }
}
