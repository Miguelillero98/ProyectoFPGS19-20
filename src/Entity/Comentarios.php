<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComentariosRepository")
 */
class Comentarios
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comentario;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_publicacion;
    
    //RELACIONES
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comentarios")
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Posts", inversedBy="comentarios")
     */
    private $post;
    
    function __construct() {
        $this->fecha_publicacion = new \DateTime();
        
    }
    
    function getFecha_publicacion() {
        return $this->fecha_publicacion;
    }

    function getUser() {
        return $this->user;
    }

    function getPost() {
        return $this->post;
    }

    function setFecha_publicacion($fecha_publicacion) {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPost($post) {
        $this->post = $post;
    }

        public function getId(): ?int
    {
        return $this->id;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fecha_publicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $fecha_publicacion): self
    {
        $this->fecha_publicacion = $fecha_publicacion;

        return $this;
    }
}
