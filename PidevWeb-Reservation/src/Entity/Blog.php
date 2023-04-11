<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_blg = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Veuillez saisir votre email")]
    #[Assert\Email(message:" Cet email :'{{ value }}' n'est pas valide ")]
    private ?string $email_blg = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu_blg = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreBlg(): ?string
    {
        return $this->titre_blg;
    }

    public function setTitreBlg(string $titre_blg): self
    {
        $this->titre_blg = $titre_blg;

        return $this;
    }

    public function getEmailBlg(): ?string
   
    {
        return $this->email_blg;
    
    }

    public function setEmailBlg(string $email_blg): self
    {
        $this->email_blg = $email_blg;

        return $this;
    }

    public function getContenuBlg(): ?string
    {
        return $this->contenu_blg;
    }

    public function setContenuBlg(string $contenu_blg): self
    {
        $this->contenu_blg = $contenu_blg;

        return $this;
    }
}
