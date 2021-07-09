<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProduitId;

    /**
     * @ORM\Column(type="integer")
     */
    private $UserId;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProduitOccur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduitId(): ?int
    {
        return $this->ProduitId;
    }

    public function setProduitId(int $ProduitId): self
    {
        $this->ProduitId = $ProduitId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->UserId;
    }

    public function setUserId(int $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }

    public function getProduitOccur(): ?int
    {
        return $this->ProduitOccur;
    }

    public function setProduitOccur(int $ProduitOccur): self
    {
        $this->ProduitOccur = $ProduitOccur;

        return $this;
    }
}
