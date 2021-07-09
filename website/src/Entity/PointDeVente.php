<?php

namespace App\Entity;

use App\Repository\PointDeVenteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PointDeVenteRepository::class)
 */
class PointDeVente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Partenaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Produits;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity_month;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartenaire(): ?string
    {
        return $this->Partenaire;
    }

    public function setPartenaire(string $Partenaire): self
    {
        $this->Partenaire = $Partenaire;

        return $this;
    }

    public function getProduits(): ?string
    {
        return $this->Produits;
    }

    public function setProduits(string $Produits): self
    {
        $this->Produits = $Produits;

        return $this;
    }

    public function getQuantityMonth(): ?int
    {
        return $this->Quantity_month;
    }

    public function setQuantityMonth(int $Quantity_month): self
    {
        $this->Quantity_month = $Quantity_month;

        return $this;
    }
}
