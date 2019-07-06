<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
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

}
