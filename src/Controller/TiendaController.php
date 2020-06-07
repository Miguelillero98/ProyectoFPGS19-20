<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pack;
use App\Repository\PackRepository;


class TiendaController extends AbstractController
{
    /**
     * @Route("/tienda", name="tienda")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $array = [];
        $array = $em->getRepository(Pack::class)->findAll();
        return $this->render('tienda/index.html.twig', [
            'f' => $array,
        ]);
    }
    
}
