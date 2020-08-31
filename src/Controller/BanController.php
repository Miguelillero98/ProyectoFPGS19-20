<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BanController extends AbstractController
{
    /**
     * @Route("/ban", name="ban")
     */
    public function index()
    {
        return $this->render('ban/index.html.twig', [
            
        ]);
    }
}
