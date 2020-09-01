<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation;
use App\Entity\User;
use App\Repository\UserRepository;

class AmigosController extends AbstractController
{
    /**
     * @Route("/amigos", name="amigos")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        
        return $this->render('amigos/index.html.twig', [
            'controller_name' => 'Amigos',
            'amigos' => $user->getMyFriends(),
            'resultado' => ''
        ]);
    }
    /**
     * @Route("/busca_amigos", name="busca_amigos")
     */
    public function search(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $resultado = '';
        $nickEnBusca = $_POST['buscaAmigo'];
        $nicks = $em->getRepository(User::class)->loadUserByUsername($nickEnBusca);
        return $this->render('amigos/index.html.twig', [
            'controller_name' => 'Amigos',
            'amigos' => $user->getMyFriends(),
            'resultado' => $nicks
        ]);
    }
    /**
     * @Route("/anadir",options={"expose"=true} , name="anadir")
     */
    public function add($id)
    {
        $user = getUser();
        $user->setMyFriends($id);
    }
}
