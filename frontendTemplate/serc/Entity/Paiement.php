<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement", indexes={@ORM\Index(name="fk_Paiement_Facture1_idx", columns={"Facture_idFacture"})})
 * @ORM\Entity
 */
class Paiement
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPaiement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpaiement;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_paiement", type="datetime", nullable=true)
     */
    private $datePaiement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mode_paiement", type="string", length=45, nullable=true)
     */
    private $modePaiement;

    /**
     * @var \Facture
     *
     * @ORM\ManyToOne(targetEntity="Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Facture_idFacture", referencedColumnName="idFacture")
     * })
     */
    private $facturefacture;


}
