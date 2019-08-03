<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DepotRepository")
 */
class Depot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   

    /**
     * @ORM\Column(type="bigint")
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDepot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="depots")
     */
    private $cassier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ComptBancaire", inversedBy="depots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $numeroCompt;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    public function getCassier(): ?User
    {
        return $this->cassier;
    }

    public function setCassier(?User $cassier): self
    {
        $this->cassier = $cassier;

        return $this;
    }

    public function getNumeroCompt(): ?ComptBancaire
    {
        return $this->numeroCompt;
    }

    public function setNumeroCompt(?ComptBancaire $numeroCompt): self
    {
        $this->numeroCompt = $numeroCompt;

        return $this;
    }
}
