<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Product_omschrijving;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Product_btw;

    /**
     * @ORM\Column(type="integer")
     */
    private $Prijs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Factuurregel", mappedBy="productcode")
     */
    private $factuurregels;

    public function __construct()
    {
        $this->factuurregels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductOmschrijving(): ?string
    {
        return $this->Product_omschrijving;
    }

    public function setProductOmschrijving(?string $Product_omschrijving): self
    {
        $this->Product_omschrijving = $Product_omschrijving;

        return $this;
    }

    public function getProductBtw(): ?string
    {
        return $this->Product_btw;
    }

    public function setProductBtw(string $Product_btw): self
    {
        $this->Product_btw = $Product_btw;

        return $this;
    }

    public function getPrijs(): ?int
    {
        return $this->Prijs;
    }

    public function setPrijs(int $Prijs): self
    {
        $this->Prijs = $Prijs;

        return $this;
    }

    /**
     * @return Collection|Factuurregel[]
     */
    public function getFactuurregels(): Collection
    {
        return $this->factuurregels;
    }

    public function addFactuurregel(Factuurregel $factuurregel): self
    {
        if (!$this->factuurregels->contains($factuurregel)) {
            $this->factuurregels[] = $factuurregel;
            $factuurregel->setProductcode($this);
        }

        return $this;
    }

    public function removeFactuurregel(Factuurregel $factuurregel): self
    {
        if ($this->factuurregels->contains($factuurregel)) {
            $this->factuurregels->removeElement($factuurregel);
            // set the owning side to null (unless already changed)
            if ($factuurregel->getProductcode() === $this) {
                $factuurregel->setProductcode(null);
            }
        }

        return $this;
    }
}
