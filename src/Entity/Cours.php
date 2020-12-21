<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
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
    private $nomC;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixC;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgC;

    /**
     * @ORM\ManyToOne(targetEntity=matiere::class, inversedBy="cours")
     */
    private $matiere;






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomC(): ?string
    {
        return $this->nomC;
    }

    public function setNomC(string $nomC): self
    {
        $this->nomC = $nomC;

        return $this;
    }

    public function getPrixC(): ?int
    {
        return $this->prixC;
    }

    public function setPrixC(int $prixC): self
    {
        $this->prixC = $prixC;

        return $this;
    }

    public function getImgC(): ?string
    {
        return $this->imgC;
    }

    public function setImgC(string $imgC): self
    {
        $this->imgC = $imgC;

        return $this;
    }

    public function getMatiere(): ?matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }





}
