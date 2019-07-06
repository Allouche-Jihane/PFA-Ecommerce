<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="fk_Facture_Commande1_idx", columns={"Commande_idCommande"})})
 * @ORM\Entity(repositoryClass="App\Repository\FactureRepository")
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFacture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfacture;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_facture", type="datetime", nullable=true)
     */
    private $dateFacture;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Commande_idCommande", referencedColumnName="idCommande")
     * })
     */
    private $commandecommande;

    public function getIdfacture(): ?int
    {
        return $this->idfacture;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->dateFacture;
    }

    public function setDateFacture(?\DateTimeInterface $dateFacture): self
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }

    public function getCommandecommande(): ?Commande
    {
        return $this->commandecommande;
    }

    public function setCommandecommande(?Commande $commandecommande): self
    {
        $this->commandecommande = $commandecommande;

        return $this;
    }


}
