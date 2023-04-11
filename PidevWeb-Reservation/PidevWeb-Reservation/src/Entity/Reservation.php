<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Veuillez saisir votre nom.")]
    private ?string $nom_res = null;
    

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Veuillez saisir votre prenom.")]
    private ?string $prenom_res = null;
    

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Veuillez saisir votre email")]
    #[Assert\Email(message:" Cet email :'{{ value }}' n'est pas valide ")]
    private ?string $email_res = null;


    #[ORM\Column(length: 255)]
    private ?string $nom_evnmt = null;

    #[ORM\Column(length: 255)]
    private ?string $typeticket_res = null;

    #[ORM\Column(length: 255)]
    #[Assert\Date(message:" Ce n'est pas une date :'{{ value }}' n'est pas valide ")]
    private ?string $date_res = null;

    #[ORM\Column(length: 255)]
    private ?string $code_offr = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRes(): ?string
    {
        return $this->nom_res;
    }

    public function setNomRes(string $nom_res): self
    {
        $this->nom_res = $nom_res;

        return $this;
    }

    public function getPrenomRes(): ?string
    {
        return $this->prenom_res;
    }

    public function setPrenomRes(string $prenom_res): self
    {
        $this->prenom_res = $prenom_res;

        return $this;
    }

    public function getEmailRes(): ?string
    {
        return $this->email_res;
    }

    public function setEmailRes(string $email_res): self
    {
        $this->email_res = $email_res;

        return $this;
    }

    public function getNomEvnmt(): ?string
    {
        return $this->nom_evnmt;
    }

    public function setNomEvnmt(string $nom_evnmt): self
    {
        $this->nom_evnmt = $nom_evnmt;

        return $this;
    }

    public function getTypeticketRes(): ?string
    {
        return $this->typeticket_res;
    }

    public function setTypeticketRes(string $typeticket_res): self
    {
        $this->typeticket_res = $typeticket_res;

        return $this;
    }

    public function getDateRes(): ?string
    {
        return $this->date_res;
    }

    public function setDateRes(string $date_res): self
    {
        $this->date_res = $date_res;

        return $this;
    }

    public function getCodeOffr(): ?string
    {
        return $this->code_offr;
    }

    public function setCodeOffr(string $code_offr): self
    {
        $this->code_offr = $code_offr;

        return $this;
    }
}
