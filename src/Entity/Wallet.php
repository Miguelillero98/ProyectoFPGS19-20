<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WalletRepository")
 */
class Wallet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Skins;
    
//ASOCIACIONES
    
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="wallet")
     */
    private $user;
    
    //CONSTRUCTOR
    function __construct($u) {
        $this->cantidad = 100;
        $this->Skins = new ArrayCollection();
        $this->user = $u;
    }

    //GETTERS ADN SETTERS

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getSkins(): ?string
    {
        return $this->Skins;
    }

    public function setSkins(string $Skins): self
    {
        $this->Skins = $Skins;

        return $this;
    }
}
