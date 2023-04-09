<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OffreRepository;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idOffre", type: "integer", nullable: false)]
    private ?int $idoffre = null;


    #[ORM\Column(name: "pourcentage", type: "integer", nullable: false)]
    private ?int $pourcentage;


    #[ORM\Column(name: "idProduit", type: "integer", nullable: false)]
    private ?int $idproduit;

    public function getIdoffre(): ?int
    {
        return $this->idoffre;
    }

    public function getPourcentage(): ?int
    {
        return $this->pourcentage;
    }

    public function setPourcentage(int $pourcentage): self
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    public function getIdproduit(): ?int
    {
        return $this->idproduit;
    }

    public function setIdproduit(int $idproduit): self
    {
        $this->idproduit = $idproduit;

        return $this;
    }
}
