<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomMat;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixMat;

    /**
     * @ORM\Column(type="string", length=255)
     * cascade={"persist"}
     */
    private $imgMat;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="matiere")
     */
    private $cours;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="matiereCom")
     */
    private $commandes;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMat(): ?string
    {
        return $this->nomMat;
    }

    public function setNomMat(string $nomMat): self
    {
        $this->nomMat = $nomMat;

        return $this;
    }

    public function getPrixMat(): ?int
    {
        return $this->prixMat;
    }

    public function setPrixMat(int $prixMat): self
    {
        $this->prixMat = $prixMat;

        return $this;
    }

    public function getImgMat(): ?string
    {
        return $this->imgMat;
    }

    public function setImgMat(string $imgMat): self
    {
        $this->imgMat = $imgMat;

        return $this;
    }

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setMatiere($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getMatiere() === $this) {
                $cour->setMatiere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addMatiereCom($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeMatiereCom($this);
        }

        return $this;
    }






}
