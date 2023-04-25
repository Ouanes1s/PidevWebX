<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationparking
 *
 * @ORM\Table(name="reservationparking", indexes={@ORM\Index(name="id_parking_constraint", columns={"id_parking"}), @ORM\Index(name="id_user_constr", columns={"id_user"})})
 * @ORM\Entity
 */
class Reservationparking
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReservation;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_hours", type="integer", nullable=false)
     */
    private $nbHours;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    /**
     * @var \Parking
     *
     * @ORM\ManyToOne(targetEntity="Parking")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parking", referencedColumnName="id_parking")
     * })
     */
    private $idParking;

    public function getIdReservation(): ?int
    {
        return $this->idReservation;
    }

    public function getNbHours(): ?int
    {
        return $this->nbHours;
    }

    public function setNbHours(int $nbHours): self
    {
        $this->nbHours = $nbHours;

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

    public function getIdParking(): ?Parking
    {
        return $this->idParking;
    }

    public function setIdParking(?Parking $idParking): self
    {
        $this->idParking = $idParking;

        return $this;
    }


}
