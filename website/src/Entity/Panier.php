<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="panier")
     */
    private $id_produit;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="panier")
     */
    private $id_user;

    /**
     * @ORM\Column(type="integer")
     */
    private $occurrence;

    public function __construct()
    {
        $this->id_produit = new ArrayCollection();
        $this->id_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getIdProduit(): Collection
    {
        return $this->id_produit;
    }

    public function addIdProduit(Produit $idProduit): self
    {
        if (!$this->id_produit->contains($idProduit)) {
            $this->id_produit[] = $idProduit;
            $idProduit->setPanier($this);
        }

        return $this;
    }

    public function removeIdProduit(Produit $idProduit): self
    {
        if ($this->id_produit->removeElement($idProduit)) {
            // set the owning side to null (unless already changed)
            if ($idProduit->getPanier() === $this) {
                $idProduit->setPanier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdUser(): Collection
    {
        return $this->id_user;
    }

    public function addIdUser(User $idUser): self
    {
        if (!$this->id_user->contains($idUser)) {
            $this->id_user[] = $idUser;
            $idUser->setPanier($this);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): self
    {
        if ($this->id_user->removeElement($idUser)) {
            // set the owning side to null (unless already changed)
            if ($idUser->getPanier() === $this) {
                $idUser->setPanier(null);
            }
        }

        return $this;
    }

    public function getOccurrence(): ?int
    {
        return $this->occurrence;
    }

    public function setOccurrence(int $occurrence): self
    {
        $this->occurrence = $occurrence;

        return $this;
    }
}
