<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PerfilController extends AbstractController
{
    /**
     * @Route("/perfil", name="perfil")
     */
    public function index()
    {
        $user = $this->getUser();
        return $this->render('perfil/index.html.twig', [
            'controller_name' => 'Perfil',
            'user' => $user,
        ]);
    }
}
