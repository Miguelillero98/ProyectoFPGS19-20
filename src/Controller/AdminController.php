<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pack;
use App\Entity\User;
use App\Entity\Posts;
use App\Entity\Comentarios;
use App\Form\AnadirPackType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PackRepository;
use App\Repository\UserRepository;
use App\Repository\PostsRepository;
use App\Repository\ComentariosRepository;

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
     * @Route("/packControl", name="packControl")
     */
    public function packControl(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $submit = $_POST['submit'];
        $id = $_POST['id'];
        $contenido = $_POST['contenido'];
        $precio = $_POST['precio'];
        $archivo = $request->files->get('imagen');
        
        if($submit == "Añadir pack"){
            $pack = new Pack();            
            $pack->setContenido($contenido);
            $pack->setPrecio($precio);
            
            $destino= $this->getParameter('fotos_directory');
            $request = Request::createFromGlobals();
            
            $archivo->move($destino,$archivo->getClientOriginalName());
            
            $pack->setFoto($archivo->getClientOriginalName());
            $em->persist($pack);
            $em->flush();
        }
        if($submit == "Eliminar pack"){
            $pack = $em->getRepository(Pack::class)->BorrarPack($id);
        }
        if($submit == "Modificar pack"){
            $pack = $em->getRepository(Pack::class)->find($id);
            if($contenido){
                $pack->setContenido($contenido);
            }
            if($precio){
                $pack->setPrecio($precio);
            }
            if($foto){
                $destino= $this->getParameter('fotos_directory');
                $request = Request::createFromGlobals();
                $archivo->move($destino,$archivo->getClientOriginalName());
                $pack->setFoto($archivo->getClientOriginalName());
            }
            $em->persist($pack);
            $em->flush();
        }
        return $this->render('admin/index.html.twig', [
            
        ]);
    }
    /**
     * @Route("/userControl", name="userControl")
     */
    public function userControl(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $em = $this->getDoctrine()->getManager();
        $submit = $_POST['submit'];
        $id = $_POST['id'];
        $password = $_POST['password'];
        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        
        if($submit == "Banear usuario"){
            $user = $em->getRepository(User::class)->find($id);
            $user->setRoles(['ROLE_BANED']);
            $em->persist($user);
            $em->flush();
        }
        if($submit == "Desbanear usuario"){
            $user = $em->getRepository(User::class)->find($id);
            $user->setRoles(['ROLE_USER']);
            $em->persist($user);
            $em->flush();
        }
        if($submit == "Modificar usuario"){
            $user = $em->getRepository(User::class)->find($id);
            if($password){
                $user->setPassword($passwordEncoder->encodePassword($user,$password));
            }
            
            if($email){
                $user->setEmail($email);
            }
            
            if($nickname){
                $user->setNickname($nickname);
            }
            $em->persist($user);
            $em->flush();
        }
        if($submit == "Eliminar usuario"){
            $user = $em->getRepository(User::class)->eliminarUser($id);
           
            $em->flush();
        }
        
        return $this->render('admin/index.html.twig', [
            
        ]);
    }
    /**
     * @Route("/postControl", name="postControl")
     */
    public function postControl(Request $request){
        $em = $this->getDoctrine()->getManager();
        $submit = $_POST['submit'];
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $foto = $request->files->get('foto');
        $contenido = $_POST['contenido'];
        
        
        if($submit == "Modificar post"){
            $post = $em->getRepository(Posts::class)->find($id);
            if($titulo){
                $post->setTitulo($titulo);
            }
            if($contenido){
                $post->setContenido($contenido);
            }
            if($foto){
                $destino= $this->getParameter('fotos_directory');
                $request = Request::createFromGlobals();
                $foto->move($destino,$foto->getClientOriginalName());
                $post->setFoto($foto->getClientOriginalName());
            }
            $em->persist($post);
            $em->flush();
        }
        if($submit == "Eliminar post"){
            $comentarios = $em->getRepository(Comentarios::class)->eliminarComentarios($id);
            $post = $em->getRepository(Posts::class)->eliminarPost($id);
            $em->flush();
        }
        
        return $this->render('admin/index.html.twig', [
            
        ]);
    }
}
