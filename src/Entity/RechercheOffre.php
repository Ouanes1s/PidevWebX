<?php

namespace App\Entity;

class RechercheOffre
{

    private $pourcentage;


    public function getPourcentage(): ?string
    {
        return $this->pourcentage;
    }

    public function setPourcentage(string $pourcentage): self
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }
}
