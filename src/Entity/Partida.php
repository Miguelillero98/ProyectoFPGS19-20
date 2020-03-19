<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
