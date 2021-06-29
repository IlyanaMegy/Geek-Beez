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
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="panier_id")
     */
    private $user_id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $product_id = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $occurence = [];

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
            $userId->setPanierId($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getPanierId() === $this) {
                $userId->setPanierId(null);
            }
        }

        return $this;
    }

    public function getProductId(): ?array
    {
        return $this->product_id;
    }

    public function setProductId(?array $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getOccurence(): ?array
    {
        return $this->occurence;
    }

    public function setOccurence(?array $occurence): self
    {
        $this->occurence = $occurence;

        return $this;
    }
}
