<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coupons
 *
 * @ORM\Table(name="coupons")
 * @ORM\Entity
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
     * @var int|null
     *
     * @ORM\Column(name="nombre_utilisation", type="integer", nullable=true)
     */
    private $nombreUtilisation;

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

}
