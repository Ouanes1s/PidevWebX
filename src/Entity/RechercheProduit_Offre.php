<?php

namespace App\Entity;

use App\Entity\Offre;
use Doctrine\ORM\Mapping as ORM;

class RechercheProduit_Offre
{


    #[ORM\ManyToOne(targetEntity: App\Entity\Offre::class)]
    private $offre;
    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }
}
