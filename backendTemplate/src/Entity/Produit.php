<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="fk_Produit_Categorie1_idx", columns={"Categorie_idCategorie"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
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
     * @ORM\Column(name="typeProduit", type="string", length=255, nullable=true)
     */
    private $typeProduit;

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
     * @var array
     *
       * @ORM\Column(name="images_additio", type="array")
     */
    private $imagesAdditio = [];

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

    public function getIdproduit(): ?int
    {
        return $this->idproduit;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setTypeProduit(?string $typeProduit): self
    {
        $this->typeProduit = $typeProduit;

        return $this;
    }
    public function getTypeProduit(): ?string
    {
        return $this->typeProduit;
    }

    public function setNomProduit(?string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImagePrincipale(): ?string
    {
        return $this->imagePrincipale;
    }

    public function setImagePrincipale(?string $imagePrincipale): self
    {
        $this->imagePrincipale = $imagePrincipale;

        return $this;
    }
    /**
         * @return mixed
    */
    public function getImagesAdditio()
    {
        return $this->imagesAdditio;
    }
    /**
     * @param mixed $imagesAdditio
     */
    public function setImagesAdditio($imagesAdditio)
    {
        $this->imagesAdditio = $imagesAdditio;

      
    }

    public function getQuantiteStock(): ?int
    {
        return $this->quantiteStock;
    }

    public function setQuantiteStock(?int $quantiteStock): self
    {
        $this->quantiteStock = $quantiteStock;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getValeurPromo(): ?float
    {
        return $this->valeurPromo;
    }

    public function setValeurPromo(?float $valeurPromo): self
    {
        $this->valeurPromo = $valeurPromo;

        return $this;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTime $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTime $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getCategoriecategorie(): ?Categorie
    {
        return $this->categoriecategorie;
    }

    public function setCategoriecategorie(?Categorie $categoriecategorie): self
    {
        $this->categoriecategorie = $categoriecategorie;

        return $this;
    }

    /**
     * @return Collection|Coupons[]
     */
    public function getCouponscoupons(): Collection
    {
        return $this->couponscoupons;
    }

    public function addCouponscoupon(Coupons $couponscoupon): self
    {
        if (!$this->couponscoupons->contains($couponscoupon)) {
            $this->couponscoupons[] = $couponscoupon;
        }

        return $this;
    }

    public function removeCouponscoupon(Coupons $couponscoupon): self
    {
        if ($this->couponscoupons->contains($couponscoupon)) {
            $this->couponscoupons->removeElement($couponscoupon);
        }

        return $this;
    }

    /**
     * @return Collection|Panier[]
     */
    public function getPanierpanier(): Collection
    {
        return $this->panierpanier;
    }

    public function addPanierpanier(Panier $panierpanier): self
    {
        if (!$this->panierpanier->contains($panierpanier)) {
            $this->panierpanier[] = $panierpanier;
            $panierpanier->addProduitproduit($this);
        }

        return $this;
    }

    public function removePanierpanier(Panier $panierpanier): self
    {
        if ($this->panierpanier->contains($panierpanier)) {
            $this->panierpanier->removeElement($panierpanier);
            $panierpanier->removeProduitproduit($this);
        }

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClientclient(): Collection
    {
        return $this->clientclient;
    }

    public function addClientclient(Client $clientclient): self
    {
        if (!$this->clientclient->contains($clientclient)) {
            $this->clientclient[] = $clientclient;
            $clientclient->addProduitproduit($this);
        }

        return $this;
    }

    public function removeClientclient(Client $clientclient): self
    {
        if ($this->clientclient->contains($clientclient)) {
            $this->clientclient->removeElement($clientclient);
            $clientclient->removeProduitproduit($this);
        }

        return $this;
    }

}
