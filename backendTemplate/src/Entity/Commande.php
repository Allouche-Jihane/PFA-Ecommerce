<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="fk_Commande_Panier1_idx", columns={"Panier_idPanier"}), @ORM\Index(name="fk_Commande_Client1_idx", columns={"Client_idClient"})})
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcommande;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_commande", type="datetime", nullable=true)
     */
    private $dateCommande;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_commande", type="string", length=25, nullable=true)
     */
    private $etatCommande;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixVente;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Client_idClient", referencedColumnName="idClient")
     * })
     */
    private $clientclient;

    /**
     * @var \Panier
     *
     * @ORM\ManyToOne(targetEntity="Panier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Panier_idPanier", referencedColumnName="idPanier")
     * })
     */
    private $panierpanier;

    public function getIdcommande(): ?int
    {
        return $this->idcommande;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(?\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getEtatCommande(): ?string
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(?string $etatCommande): self
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }

    public function getPrixVente(): ?float
    {
        return $this->prixVente;
    }

    public function setPrixVente(?float $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getClientclient(): ?Client
    {
        return $this->clientclient;
    }

    public function setClientclient(?Client $clientclient): self
    {
        $this->clientclient = $clientclient;

        return $this;
    }

    public function getPanierpanier(): ?Panier
    {
        return $this->panierpanier;
    }

    public function setPanierpanier(?Panier $panierpanier): self
    {
        $this->panierpanier = $panierpanier;

        return $this;
    }


}
