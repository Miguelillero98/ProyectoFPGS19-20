<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;
use App\Repository\UserRepository;

class AmigosController extends AbstractController
{
    /**
     * @Route("/amigos", name="amigos")
     */
    public function index(Request $re)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $query = $em->getRepository(User::class)->loadFriends($user);
        
        return $this->render('amigos/index.html.twig', [
            'controller_name' => 'Amigos',
            'amigos' => $query,
        ]);
    }
    /**
     * @Route("/anadir_amigos",options={"expose"=true} , name="anadir_amigos")
     */
    public function add(Request $request)
    {
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $nickname = $request->request->get('nickname');
            $addUser = $em->getRepository(User::class)->loadUserByUsername($nickname);
            return new JsonResponse(['addUser'=>$addUser]);
        }else{
            throw new \Exception('no me hackes');
        }        
        
    }
}
