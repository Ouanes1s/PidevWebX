<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Parking
 *
 * @ORM\Table(name="parking")
 * @ORM\Entity
 */
class Parking
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_parking", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParking;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_parking", type="string", length=255, nullable=false)
     */
    #[Assert\NotBlank(message: "Veuillez entrer le nom du parking")]
    private $nomParking;

    /**
     * @var string
     *
     * @ORM\Column(name="logo_parking", type="string", length=255, nullable=false)
     */
    #[Assert\NotBlank(message: "Veuillez entrer le banner du parking")]
    private $logoParking;

    /**
     * @var int
     *
     * @ORM\Column(name="capacite_parking", type="integer", nullable=false)
     */
    #[Assert\NotBlank(message: "Veuillez entrer la capacite du parking")]
    private $capaciteParking;

    /**
     * @var int
     *
     * @ORM\Column(name="takenP_parking", type="integer", nullable=false)
     */
    #[Assert\NotBlank(message: "Veuillez entrer le nbre des places taken du parking")]
    private $takenpParking;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_parking", type="float", precision=10, scale=0, nullable=false)
     */
    #[Assert\NotBlank(message: "Veuillez entrer le prix du parking")]
    private $prixParking;

    public function getIdParking(): ?int
    {
        return $this->idParking;
    }

    public function getNomParking(): ?string
    {
        return $this->nomParking;
    }

    public function setNomParking(string $nomParking): self
    {
        $this->nomParking = $nomParking;

        return $this;
    }

    public function getLogoParking(): ?string
    {
        return $this->logoParking;
    }

    public function setLogoParking(string $logoParking): self
    {
        $this->logoParking = $logoParking;

        return $this;
    }

    public function getCapaciteParking(): ?int
    {
        return $this->capaciteParking;
    }

    public function setCapaciteParking(int $capaciteParking): self
    {
        $this->capaciteParking = $capaciteParking;

        return $this;
    }

    public function getTakenpParking(): ?int
    {
        return $this->takenpParking;
    }

    public function setTakenpParking(int $takenpParking): self
    {
        $this->takenpParking = $takenpParking;

        return $this;
    }

    public function getPrixParking(): ?float
    {
        return $this->prixParking;
    }

    public function setPrixParking(float $prixParking): self
    {
        $this->prixParking = $prixParking;

        return $this;
    }


}
