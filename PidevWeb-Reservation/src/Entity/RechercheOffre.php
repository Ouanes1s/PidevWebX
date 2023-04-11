<?php

namespace App\Entity;

class RechercheOffre
{

    private $nomfilm_offr;


    public function getNomfilmOffr(): ?string
    {
        return $this->nomfilm_offr;
    }

    public function setNomfilmOffr(string $nomfilm_offr): self
    {
        $this->nomfilm_offr = $nomfilm_offr;

        return $this;
    }
}
