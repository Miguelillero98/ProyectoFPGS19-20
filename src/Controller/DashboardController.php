<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/logued", name="principal")
     */
    public function index()
    {
        $user = $this->getUser();
        $roles = $user->getRoles();
        if($roles[0] == "ROLE_BANED"){
            return $this->redirectToRoute('ban');
        }else{
        return $this->render('dashboard/index.html.twig', [
            'user' => $user,
        ]);}
    }
}
