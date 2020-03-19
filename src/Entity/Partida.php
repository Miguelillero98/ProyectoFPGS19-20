<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartidaRepository")
 */
class Partida
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
    private $apuesta;
    
//ASOCIACIONES
     /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     * @ORM\JoinTable(name="jugadores",
     *      joinColumns={@ORM\JoinColumn(name="partida_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="users_id", referencedColumnName="id")}
     *      )
     */
    private $jugadores;
    
    public function __construct()
    {
        $this->jugadores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApuesta(): ?int
    {
        return $this->apuesta;
    }

    public function setApuesta(int $apuesta): self
    {
        $this->apuesta = $apuesta;

        return $this;
    }
}
