<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="fk_Produit_Categorie1_idx", columns={"Categorie_idCategorie"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProduit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproduit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_produit", type="string", length=45, nullable=true)
     */
    private $nomProduit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_principale", type="string", length=255, nullable=true)
     */
    private $imagePrincipale;

    /**
     * @var string|null
     *
     * @ORM\Column(name="images_additio", type="string", length=255, nullable=true)
     */
    private $imagesAdditio;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantite_stock", type="integer", nullable=true)
     */
    private $quantiteStock;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    private $actif;

    /**
     * @var float|null
     *
     * @ORM\Column(name="valeur_promo", type="float", precision=10, scale=0, nullable=true)
     */
    private $valeurPromo;

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
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Categorie_idCategorie", referencedColumnName="idCategorie")
     * })
     */
    private $categoriecategorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Coupons", inversedBy="produitproduit")
     * @ORM\JoinTable(name="coupons_products",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Produit_idProduit", referencedColumnName="idProduit")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Coupons_idCoupons", referencedColumnName="idCoupons")
     *   }
     * )
     */
    private $couponscoupons;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Panier", mappedBy="produitproduit")
     */
    private $panierpanier;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Client", mappedBy="produitproduit")
     */
    private $clientclient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->couponscoupons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->panierpanier = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clientclient = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
