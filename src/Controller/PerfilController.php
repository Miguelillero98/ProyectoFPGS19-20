<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PerfilController extends AbstractController
{
    /**
     * @Route("/perfil", name="perfil")
     */
    public function index()
    {
        $user = $this->getUser();
        return $this->render('perfil/index.html.twig', [
            'nickerror' => '',
            'emailerror' => '',
            'controller_name' => 'Perfil',
            'user' => $user,
        ]);
    }
    /**
     * @Route("/cambiaNick", name="cambiaNick")
     */
    public function cambiaNick()
    {
        $existe=false;
        $nickerror = '';
        $em = $this->getDoctrine()->getManager();
        $nickname = $_POST['nickname'];
        $user = $this->getUser();
        $usuarios = $em->getRepository(User::class)->buscarPorCampo('nickname', $nickname);
        
        if($nickname){
            for($i=0;$i < count($usuarios);$i++){
                if($usuarios[$i] == $nickname){
                    $existe=true;
                    break;
                }
            }
            if($existe){
                $nickerror = 'Nick en uso, por favor elija otro';   
            }else{
                $user->setNickname($nickname);
                $em->persist($user);
                $em->flush();
            }
        }
        return $this->render('perfil/index.html.twig', [
            'user' => $user,
            'emailerror' => '',
            'controller_name' => 'Perfil',
            'nickerror' => $nickerror
        ]);
    }
    /**
     * @Route("/cambiaEmail", name="cambiaEmail")
     */
    public function cambiaEmail()
    {
        $existe=false;
        $emailerror = '';
        $em = $this->getDoctrine()->getManager();
        $email = $_POST['email'];
        $user = $this->getUser();
        $usuarios = $em->getRepository(User::class)->buscarPorCampo('email', $email);
        
        if($email){
            for($i=0;$i < count($usuarios) ;$i++){
                console.log($usuarios[$i]);
                if($usuarios[$i] == $email && isset($email)){
                    $existe=true;
                    break;
                }
            }
            if($existe){
                $emailerror = 'Email en uso, por favor elija otro';
            }else{
                $user->setEmail($email);
                $em->persist($user);
                $em->flush();
            }
        }
        return $this->render('perfil/index.html.twig', [
            'user' => $user,
            'nickerror' => '',
            'controller_name' => 'Perfil',
            'emailerror' => $emailerror
        ]);
    }
    /**
     * @Route("/cambiaPass", name="cambiaPass")
     */
    public function cambiaPass(UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $password = $_POST['password'];
        $user = $this->getUser();
        if($password){
            $user->setPassword($passwordEncoder->encodePassword($user,$password));
            $em->persist($user);
            $em->flush();
        }
        
        return $this->render('perfil/index.html.twig', [
            'user' => $user,
            'nickerror' => '',
            'emailerror' => '',
            'controller_name' => 'Perfil',
        ]);
    }
}
