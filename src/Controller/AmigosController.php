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
<<<<<<< HEAD
        $em = $this->getDoctrine()->getManager();
        $nickname = $request->request->get('nick');
        $addUser = $em->getRepository(User::class)->loadUserByUsername($nickname);
        return new JsonResponse(['addUser'=>$addUser]);
    }
    /**
     * @Route("/anadir",options={"expose"=true} , name="anadir")
     */
    public function add($id)
    {
        $user = getUser();
        $user->setMyFriends($id);
=======
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $nickname = $request->request->get('nickname');
            $addUser = $em->getRepository(User::class)->loadUserByUsername($nickname);
            return new JsonResponse(['addUser'=>$addUser]);
        }else{
            throw new \Exception('no me hackes');
        }        
        
>>>>>>> parent of 3edea8d... 24/03
    }
}
