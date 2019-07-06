<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sortiestock
 *
 * @ORM\Table(name="sortiestock", indexes={@ORM\Index(name="fk_SortieStock_Commande1_idx", columns={"Commande_idCommande"})})
 * @ORM\Entity
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


}
