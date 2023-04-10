<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent extends User
{
    /*#[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;*/

    #[ORM\Column(length: 255)]
    private ?string $salaire = null;
    #[ORM\Column(length: 255)]
    private ?string $date_contract = null;
    #[ORM\Column]
    private array $type_a = [];

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
    public function getSalaire(): ?string
    {
        return $this->salaire;
    }

    public function setSalaire(string $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getTypeA(): array
    {
        $type_a = $this->type_a;
        // guarantee every user at least has ROLE_USER
        $type_a[] = 'ROLE_USER';

        return array_unique($type_a);
    }
    public function gettype_A(): array
    {
        $type_a = $this->type_a;
        // guarantee every user at least has ROLE_USER
        $type_a[] = 'ROLE_USER';

        return array_unique($type_a);
    }
    public function setTypeA(array $type_a): self
    {
        $this->type_a = $type_a;

        return $this;
    }

	/**
	 * @return string|null
	 */
	public function getDateContract(): ?string {
		return $this->date_contract;
	}
	public function getdate_contract(): ?string {
		return $this->date_contract;
	}
	
	/**
	 * @param string|null $date_contract 
	 * @return self
	 */
	public function setDateContract(?string $date_contract): self {
		$this->date_contract = $date_contract;
		return $this;
	}
}
