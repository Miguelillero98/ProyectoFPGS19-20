<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProximamenteController extends AbstractController
{
    /**
     * @Route("/comming", name="comming")
     */
    public function index()
    {
        return $this->render('proximamente/index.html.twig', []);
    }
}
