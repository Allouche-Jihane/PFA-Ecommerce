<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 *@ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="idClient", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idclient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_client", type="string", length=45, nullable=true)
     */
    private $nomClient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom_client", type="string", length=45, nullable=true)
     */
    private $prenomClient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email_client", type="string", length=45, nullable=true)
     */
    private $emailClient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tel", type="string", length=45, nullable=true)
     */
    private $tel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=100, nullable=true)
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_postal", type="string", length=45, nullable=true)
     */
    private $codePostal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", inversedBy="clientclient")
     * @ORM\JoinTable(name="wishlist",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Client_idClient", referencedColumnName="idClient")
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

    public function getIdclient(): ?int
    {
        return $this->idclient;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(?string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(?string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->emailClient;
    }

    public function setEmailClient(?string $emailClient): self
    {
        $this->emailClient = $emailClient;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

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
