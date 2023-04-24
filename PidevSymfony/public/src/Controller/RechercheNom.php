<?php

namespace App\Entity;

class RechercheNom
{

    private $nom_user;


    public function getnom_user(): ?string
    {
        return $this->nom_user;
    }

    public function setNom_user(string $nom_user): self
    {
        $this->nom_user = $nom_user;

        return $this;
    }
}
