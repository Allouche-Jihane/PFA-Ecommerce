<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles", indexes={@ORM\Index(name="fk_Roles_Admin1_idx", columns={"Admin_idAdmin"})})
 * @ORM\Entity(repositoryClass="App\Repository\RolesRepository")
 */
class Roles
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRoles", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idroles;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_role", type="string", length=255, nullable=true)
     */
    private $nomRole;

    /**
     * @var \Admin
     *
     * @ORM\ManyToOne(targetEntity="Admin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Admin_idAdmin", referencedColumnName="idAdmin")
     * })
     */
    private $adminadmin;

    public function getIdroles(): ?int
    {
        return $this->idroles;
    }

    public function getNomRole(): ?string
    {
        return $this->nomRole;
    }

    public function setNomRole(?string $nomRole): self
    {
        $this->nomRole = $nomRole;

        return $this;
    }

    public function getAdminadmin(): ?Admin
    {
        return $this->adminadmin;
    }

    public function setAdminadmin(?Admin $adminadmin): self
    {
        $this->adminadmin = $adminadmin;

        return $this;
    }


}
