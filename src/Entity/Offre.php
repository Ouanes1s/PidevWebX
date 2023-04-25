<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OffreRepository;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="offre", uniqueConstraints={@ORM\UniqueConstraint(name="pourcentage_unique", columns={"pourcentage"})})
 */
#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id", type: "integer", nullable: false)]
    private ?int $id = null;


    #[ORM\Column(name: "pourcentage", type: "integer", nullable: false)]
    private ?int $pourcentage;

    /*
    #[ORM\Column(name: "idProduit", type: "integer", nullable: true)]
    private ?int $idproduit = 0;
    */
    #[ORM\OneToMany(mappedBy: 'Offre', targetEntity: Produit::class)]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPourcentage(): ?int
    {
        return $this->pourcentage;
    }

    public function setPourcentage(int $pourcentage): self
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }
    /*
    public function getIdproduit(): ?int
    {
        return $this->idproduit;
    }

    public function setIdproduit(int $idproduit): self
    {
        $this->idproduit = $idproduit;

        return $this;
    }
*/
    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setOffre($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getOffre() === $this) {
                $produit->setOffre(null);
            }
        }

        return $this;
    }
}
