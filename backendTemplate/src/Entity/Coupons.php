<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Coupons
 *
 * @ORM\Table(name="coupons")
 * @ORM\Entity(repositoryClass="App\Repository\CouponsRepository")
 */
class Coupons
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCoupons", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcoupons;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_coupon", type="string", length=255, nullable=true)
     */
    private $nomCoupon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_coupon", type="string", length=45, nullable=true)
     */
    private $codeCoupon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="value", type="decimal", precision=50, scale=0, nullable=true)
     */
    private $value;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="valide", type="boolean", nullable=true)
     */
    private $valide;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nombre_personne", type="integer", nullable=true)
     */
    private $nombrePersonne;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateCreation", type="date", nullable=true)
     */
    private $dateCreation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="limite_utilisation", type="integer", nullable=true)
     */
    private $limiteUtilisation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="couponscoupons")
     */
    private $produitproduit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produitproduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdcoupons(): ?int
    {
        return $this->idcoupons;
    }

    public function getNomCoupon(): ?string
    {
        return $this->nomCoupon;
    }

    public function setNomCoupon(?string $nomCoupon): self
    {
        $this->nomCoupon = $nomCoupon;

        return $this;
    }

    public function getCodeCoupon(): ?string
    {
        return $this->codeCoupon;
    }

    public function setCodeCoupon(?string $codeCoupon): self
    {
        $this->codeCoupon = $codeCoupon;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(?bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    public function getNombrePersonne(): ?int
    {
        return $this->nombrePersonne;
    }

    public function setNombrePersonne(?int $nombrePersonne): self
    {
        $this->nombrePersonne = $nombrePersonne;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
    public function getLimiteUtilisation(): ?int
    {
        return $this->limiteUtilisation;
    }

    public function setLimiteUtilisation(?int $limiteUtilisation): self
    {
        $this->limiteUtilisation = $limiteUtilisation;

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
            $produitproduit->addCouponscoupon($this);
        }

        return $this;
    }

    public function removeProduitproduit(Produit $produitproduit): self
    {
        if ($this->produitproduit->contains($produitproduit)) {
            $this->produitproduit->removeElement($produitproduit);
            $produitproduit->removeCouponscoupon($this);
        }

        return $this;
    }

}
