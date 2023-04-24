<?php

namespace App\Entity;

class RechercheNom
{

    private $nom_user;


    public function getNomUser(): ?string
    {
        return $this->nom_user;
    }

    public function setNomUser(string $nom_user): self
    {
        $this->nom_user = $nom_user;

        return $this;
    }
}
