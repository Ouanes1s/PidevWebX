<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre extends User
{
    /*#[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;*/

    #[ORM\Column(length: 255)]
    private ?string $date_inscri = null;

    public function getId(): ?int
    {
        return parent::getId();
    }
    public function getnom_user(): ?string
    {
        
            return $this->getNomUser();
        
            
        

    }
    
   
    public function getprenom_user(): ?string
    {
        return parent::getPrenomUser();
    }
    public function getcin_user(): ?string
    {
        return parent::getCinUser();
    }
    public function getdate_inscri(): ?string
    {
        return $this->date_inscri;
    }
    public function getDateInscri(): ?string
    {
        return $this->date_inscri;
    }

    public function setDateInscri(string $date_inscri): self
    {
        $this->date_inscri = $date_inscri;

        return $this;
    }
}
