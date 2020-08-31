<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Form\RegistroType;

class RegistroController extends AbstractController
{
    /**
     * @Route("/regist", name="regist")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $usuarioRegistrando = new User();
        
        $form = $this->createForm(RegistroType::class, $usuarioRegistrando);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $usuarioRegistrando->setPassword($passwordEncoder->encodePassword($usuarioRegistrando,$form['password']->getData()));
            $em->persist($usuarioRegistrando);
            $em->flush();
            $this->addFlash('exito', 'Se ha registrado exitosamente');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'RegistroController',
            'form'=> $form->createView(),
        ]);
    }
}
