<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPanier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpanier;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nombre_articles", type="integer", nullable=true)
     */
    private $nombreArticles;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Total", type="float", precision=10, scale=0, nullable=true)
     */
    private $total;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", inversedBy="panierpanier")
     * @ORM\JoinTable(name="lignecommandearticle",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Panier_idPanier", referencedColumnName="idPanier")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Produit_idProduit", referencedColumnName="idProduit")
     *   }
     * )
     */
    private $produitproduit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produitproduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdpanier(): ?int
    {
        return $this->idpanier;
    }

    public function getNombreArticles(): ?int
    {
        return $this->nombreArticles;
    }

    public function setNombreArticles(?int $nombreArticles): self
    {
        $this->nombreArticles = $nombreArticles;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduitproduit(): Collection
    {
        return $this->produitproduit;
    }

    public function addProduitproduit(Produit $produitproduit): self
    {
        if (!$this->produitproduit->contains($produitproduit)) {
            $this->produitproduit[] = $produitproduit;
        }

        return $this;
    }

    public function removeProduitproduit(Produit $produitproduit): self
    {
        if ($this->produitproduit->contains($produitproduit)) {
            $this->produitproduit->removeElement($produitproduit);
        }

        return $this;
    }

}
