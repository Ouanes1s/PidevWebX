<?php

namespace App\Entity;

use App\Entity\Categorie;
use Doctrine\ORM\Mapping as ORM;

class RechercheProduit_Categ
{

    #[ORM\ManyToOne(targetEntity: App\Entity\Categorie::class)]
    private $categorie;
    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
