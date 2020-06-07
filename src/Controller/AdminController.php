<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pack;
use App\Form\AnadirPackType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PackRepository;
use App\Repository\UserRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request)
    {
        return $this->render('admin/index.html.twig', [
            
        ]);
    }
    /**
     * @Route("/ap", name="ap")
     */
    public function ap(Request $request)
    {
        $form = $this->createForm(AnadirPackType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $usuarioRegistrando->setPassword($passwordEncoder->encodePassword($usuarioRegistrando,$form['password']->getData()));
            $em->persist($usuarioRegistrando);
            $em->persist($wallet);
            $em->persist($carro);
            $em->flush();
            $this->addFlash('exito', 'Se ha registrado exitosamente');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/ap.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
