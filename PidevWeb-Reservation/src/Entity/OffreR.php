<?php

namespace App\Entity;

use App\Repository\OffreRRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRRepository::class)]
class OffreR
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomfilm_offr = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu_offr = null;

    #[ORM\Column(length: 255)]
    private ?string $datedebut_offr = null;

    #[ORM\Column(length: 255)]
    private ?string $datefin_offr = null;

    #[ORM\Column(length: 8)]
    private ?string $code_offr = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomfilmOffr(): ?string
    {
        return $this->nomfilm_offr;
    }

    public function setNomfilmOffr(string $nomfilm_offr): self
    {
        $this->nomfilm_offr = $nomfilm_offr;

        return $this;
    }

    public function getContenuOffr(): ?string
    {
        return $this->contenu_offr;
    }

    public function setContenuOffr(string $contenu_offr): self
    {
        $this->contenu_offr = $contenu_offr;

        return $this;
    }

    public function getDatedebutOffr(): ?string
    {
        return $this->datedebut_offr;
    }

    public function setDatedebutOffr(string $datedebut_offr): self
    {
        $this->datedebut_offr = $datedebut_offr;

        return $this;
    }

    public function getDatefinOffr(): ?string
    {
        return $this->datefin_offr;
    }

    public function setDatefinOffr(string $datefin_offr): self
    {
        $this->datefin_offr = $datefin_offr;

        return $this;
    }

    public function getCodeOffr(): ?string
    {
        return $this->code_offr;
    }

    public function setCodeOffr(string $code_offr): self
    {
        $this->code_offr = $code_offr;

        return $this;
    }
}
