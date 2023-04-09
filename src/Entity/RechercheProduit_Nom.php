<?php

namespace App\Entity;

class RechercheProduit_Nom
{

    private $productname;


    public function getProductname(): ?string
    {
        return $this->productname;
    }

    public function setProductname(string $productname): self
    {
        $this->productname = $productname;

        return $this;
    }
}
