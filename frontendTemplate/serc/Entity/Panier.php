<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity
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

}
