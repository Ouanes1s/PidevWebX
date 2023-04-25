<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class RecherchePrix
{

    #[Assert\Positive]
    private ?int $minPrice = null;

    #[Assert\Positive]
    private ?int $maxPrice = null;


    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(int $minPrice): self
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }
}
