<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sortiestock
 *
 * @ORM\Table(name="sortiestock", indexes={@ORM\Index(name="fk_SortieStock_Commande1_idx", columns={"Commande_idCommande"})})
 * @ORM\Entity(repositoryClass="App\Repository\SortiestockRepository")
 */
class Sortiestock
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSortieStock", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsortiestock;

    /**
     * @var int|null
     *
     * @ORM\Column(name="qte_sortie", type="integer", nullable=true)
     */
    private $qteSortie;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix_vente", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixVente;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Commande_idCommande", referencedColumnName="idCommande")
     * })
     */
    private $commandecommande;

    public function getIdsortiestock(): ?int
    {
        return $this->idsortiestock;
    }

    public function getQteSortie(): ?int
    {
        return $this->qteSortie;
    }

    public function setQteSortie(?int $qteSortie): self
    {
        $this->qteSortie = $qteSortie;

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
