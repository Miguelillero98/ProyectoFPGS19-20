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
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        
        return $this->render('amigos/index.html.twig', [
            'controller_name' => 'Amigos',
            'amigos' => $user->getMyFriends(),
        ]);
    }
    /**
     * @Route("/busca_amigos",options={"expose"=true} , name="busca_amigos")
     */
    public function search(Request $request)
    {
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $nickname = $request->request->get('b');
            $addUser = $em->getRepository(User::class)->loadUserByUsername($nickname);
            if($addUser){
                $encoders=[new JsonEncoder(),];
                $normalizers = [new ObjetNormalizer(),];
                $serializer= new Serializer($normalizers, $encoders);
                $data = $serializer->serialize($addUser,'json');
                return new JsonResponse($data,200,[],true);
            }
            
        }
        return new JsonResponse(['type' => 'error', 'message' => 'AJAX only']);
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
