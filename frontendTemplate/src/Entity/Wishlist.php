<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** 
* @ORM\Entity
* @ORM\Table(name="wishlist")
 * @ORM\Entity(repositoryClass="App\Repository\WishlistRepository")
*/
class Wishlist {

    /**
     *  @var int
     * @ORM\Column(name="idWishlist", type="integer", nullable=false)
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
    public $id;

    /**
    * @ORM\ManyToOne(targetEntity=Client::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Client_idClient", referencedColumnName="idClient")
     * })
    */
    public $user;

    /**
    * @ORM\ManyToOne(targetEntity=Produit::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Produit_idProduit", referencedColumnName="idProduit")
     * })
    */
    public $produit;

    public function getUser(): ?Client
    {
        return $this->user;
    }

    public function setUser(?Client $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

}
?>