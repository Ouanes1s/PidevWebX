<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(name: "barcode", type: "string", length: 25, nullable: false)]
    #[Assert\NotBlank(message: "Veuillez entrer un barcode pour le produit")]
    private ?string $barcode;


    #[ORM\Column(name: "productName", type: "text", nullable: false)]
    #[Assert\NotBlank(message: "Veuillez entrer un nom pour le produit")]
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: "Le nom d'un produit doit comporter au moins {{ limit }} caractères",
        maxMessage: "Le nom d'un produit doit comporter au plus {{ limit }} caractères"
    )]
    private ?string $productname;


    #[ORM\Column(type: 'float', precision: 10, scale: 0, nullable: false, name: 'purchasePrice')]
    #[Assert\NotNull(message: "Veuillez entrer un prix pour le produit")]
    #[Assert\GreaterThan(value: 0, message: "Le prix doit être supérieur à 0")]
    private ?float $purchaseprice;


    #[ORM\Column(name: "etat", type: "integer", nullable: false)]
    private ?int $etat;


    #[ORM\Column(type: 'float', precision: 10, scale: 0, nullable: false)]
    private ?float $quantite;


    #[ORM\Column(name: "descriptionProduct", type: "text", nullable: false)]
    private ?string $descriptionproduct;


    #[ORM\Column(name: "imageProduct", type: "blob", length: 16777215, nullable: false)]
    private $imageproduct;


    #[ORM\Column(name: "insertionDate", type: "date", nullable: true)]
    private ?\DateTimeInterface $insertiondate;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Categorie $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getProductname(): ?string
    {
        return $this->productname;
    }

    public function setProductname(string $productname): self
    {
        $this->productname = $productname;

        return $this;
    }

    public function getPurchaseprice(): ?float
    {
        return $this->purchaseprice;
    }

    public function setPurchaseprice(float $purchaseprice): self
    {
        $this->purchaseprice = $purchaseprice;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDescriptionproduct(): ?string
    {
        return $this->descriptionproduct;
    }

    public function setDescriptionproduct(string $descriptionproduct): self
    {
        $this->descriptionproduct = $descriptionproduct;

        return $this;
    }

    public function getImageproduct()
    {
        return $this->imageproduct;
    }

    public function setImageproduct($imageproduct): self
    {
        $this->imageproduct = $imageproduct;

        return $this;
    }

    public function getInsertiondate(): ?\DateTimeInterface
    {
        return $this->insertiondate;
    }

    public function setInsertiondate(?\DateTimeInterface $insertiondate): self
    {
        $this->insertiondate = $insertiondate;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
