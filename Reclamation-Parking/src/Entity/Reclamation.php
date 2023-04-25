<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="id_user_constraint", columns={"id_user"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReclamation;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reclamation", type="date", nullable=false)
     */
    private $dateReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_reclamation", type="string", length=255, nullable=false)
     */
    #[Assert\NotBlank(message: "Veuillez entrer une categorie de reclamation")]
    private $categorieReclamation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type_reclamation", type="string", length=255, nullable=true)
     */
    #[Assert\NotBlank(message: "Veuillez entrer un type de reclamation")]
    private $typeReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="message_reclamation", type="string", length=255, nullable=false)
     */
    #[Assert\NotBlank(message: "Veuillez entrer un message de reclamation")]
    private $messageReclamation;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="etat_reclamation", type="boolean", nullable=true)
     */
    private $etatReclamation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="importance_reclamation", type="integer", nullable=true)
     */
    #[Assert\NotBlank(message: "Veuillez entrer l'importance de reclamation")]
    private $importanceReclamation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reponse_reclamation", type="string", length=255, nullable=true)
     */
    private $reponseReclamation;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    public function getIdReclamation(): ?int
    {
        return $this->idReclamation;
    }

    public function getDateReclamation(): ?\DateTimeInterface
    {
        return $this->dateReclamation;
    }

    public function setDateReclamation(\DateTimeInterface $dateReclamation): self
    {
        $this->dateReclamation = $dateReclamation;

        return $this;
    }

    public function getCategorieReclamation(): ?string
    {
        return $this->categorieReclamation;
    }

    public function setCategorieReclamation(string $categorieReclamation): self
    {
        $this->categorieReclamation = $categorieReclamation;

        return $this;
    }

    public function getTypeReclamation(): ?string
    {
        return $this->typeReclamation;
    }

    public function setTypeReclamation(?string $typeReclamation): self
    {
        $this->typeReclamation = $typeReclamation;

        return $this;
    }

    public function getMessageReclamation(): ?string
    {
        return $this->messageReclamation;
    }

    public function setMessageReclamation(string $messageReclamation): self
    {
        $this->messageReclamation = $messageReclamation;

        return $this;
    }

    public function isEtatReclamation(): ?bool
    {
        return $this->etatReclamation;
    }

    public function setEtatReclamation(?bool $etatReclamation): self
    {
        $this->etatReclamation = $etatReclamation;

        return $this;
    }

    public function getImportanceReclamation(): ?int
    {
        return $this->importanceReclamation;
    }

    public function setImportanceReclamation(?int $importanceReclamation): self
    {
        $this->importanceReclamation = $importanceReclamation;

        return $this;
    }

    public function getReponseReclamation(): ?string
    {
        return $this->reponseReclamation;
    }

    public function setReponseReclamation(?string $reponseReclamation): self
    {
        $this->reponseReclamation = $reponseReclamation;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
