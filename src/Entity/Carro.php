<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CarroRepository")
 */
class Carro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
//ASOCIACIONES    
    
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="carro")
     */
    private $user;
    
     /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pack")
     * @ORM\JoinTable(name="carro_packs",
     *      joinColumns={@ORM\JoinColumn(name="carro_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pack_id", referencedColumnName="id")}
     *      )
     */
    private $packs;
    function __construct() {
        $this->packs = new ArrayCollection();
    }

        public function getId(): ?int
    {
        return $this->id;
    }
}
