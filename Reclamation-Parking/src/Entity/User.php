<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_user", type="string", length=255, nullable=false)
     */
    private $prenomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="cin_user", type="string", length=255, nullable=false)
     */
    private $cinUser;

    /**
     * @var string
     *
     * @ORM\Column(name="email_user", type="string", length=255, nullable=false)
     */
    private $emailUser;

    /**
     * @var string
     *
     * @ORM\Column(name="role_user", type="string", length=255, nullable=false)
     */
    private $roleUser;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp_user", type="string", length=255, nullable=false)
     */
    private $mdpUser;

    /**
     * @var string
     *
     * @ORM\Column(name="Date_inscri", type="string", length=255, nullable=false)
     */
    private $dateInscri;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_user", type="string", length=255, nullable=false)
     */
    private $nomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="Salaire", type="string", length=255, nullable=false)
     */
    private $salaire;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_A", type="string", length=255, nullable=false)
     */
    private $typeA;

    /**
     * @var string
     *
     * @ORM\Column(name="date_contract", type="string", length=255, nullable=false)
     */
    private $dateContract;

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenomUser;
    }

    public function setPrenomUser(string $prenomUser): self
    {
        $this->prenomUser = $prenomUser;

        return $this;
    }

    public function getCinUser(): ?string
    {
        return $this->cinUser;
    }

    public function setCinUser(string $cinUser): self
    {
        $this->cinUser = $cinUser;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->emailUser;
    }

    public function setEmailUser(string $emailUser): self
    {
        $this->emailUser = $emailUser;

        return $this;
    }

    public function getRoleUser(): ?string
    {
        return $this->roleUser;
    }

    public function setRoleUser(string $roleUser): self
    {
        $this->roleUser = $roleUser;

        return $this;
    }

    public function getMdpUser(): ?string
    {
        return $this->mdpUser;
    }

    public function setMdpUser(string $mdpUser): self
    {
        $this->mdpUser = $mdpUser;

        return $this;
    }

    public function getDateInscri(): ?string
    {
        return $this->dateInscri;
    }

    public function setDateInscri(string $dateInscri): self
    {
        $this->dateInscri = $dateInscri;

        return $this;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): self
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getSalaire(): ?string
    {
        return $this->salaire;
    }

    public function setSalaire(string $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getTypeA(): ?string
    {
        return $this->typeA;
    }

    public function setTypeA(string $typeA): self
    {
        $this->typeA = $typeA;

        return $this;
    }

    public function getDateContract(): ?string
    {
        return $this->dateContract;
    }

    public function setDateContract(string $dateContract): self
    {
        $this->dateContract = $dateContract;

        return $this;
    }


}
