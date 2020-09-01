<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsType;
use App\Entity\Comentarios;
use App\Form\ComentariosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class PostsController extends AbstractController
{
    /**
     * @Route("/foro", name="foro")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository(Posts::class)->buscaPosts();
        $pagination = $paginator->paginate($query, /* query NOT result */ $request->query->getInt('page', 1), /*page number*/ 2 /*limit per page*/);
        return $this->render('posts/dashboardPost.html.twig', [
            'controller_name' => 'Foro',
            'pagination' => $pagination,
        ]);
    }
    /**
     * @Route("/registrar-posts", name="posts")
     */
    public function registrarPost(Request $request)
    {
        $post = new Posts();
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fotoFile = $form->get('foto')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($fotoFile) {
                $originalFilename = pathinfo($fotoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = $originalFilename.'-'.uniqid().'.'.$fotoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $fotoFile->move(
                        $this->getParameter('fotos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw \Exception('UPS, ha ocurrido un error, sorry :C');
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $post->setFoto($newFilename);
            }
            
            
            $user = $this->getUser();
            $post->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('foro');
        }
        
        return $this->render('posts/index.html.twig', [
            'controller_name' => 'Crear Posts',
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/posts/{id}", name="verPost")
     */
    public function verPost($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $post = $em->getRepository(Posts::class)->find($id);
        $comentario = new Comentarios();
        $comentario->setPost($post);
        $comentario->setUser($user);
        $form = $this->createForm(ComentariosType::class, $comentario);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($comentario);
            $em->flush();
        }
        $comentarios = $em->getRepository(Comentarios::class)->findBy(['post' => $post]);
        return $this->render('posts/verPost.html.twig', [
            'formComentarios' => $form->createView(),
            'post' => $post,
            'comentarios' => $comentarios
        ]);
    }
    
    /**
     * @Route("/mis-posts", name="misPosts")
     */
    public function verPostUsuario()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $post = $em->getRepository(Posts::class)->findby(['user' => $user]);
        return $this->render('posts/MisPost.html.twig', ['post' => $post]);
    }
    /**
     * @Route("/likes", options={"expose"=true}, name="likes")
     */
    public function like(Request $request) {
        $nogustaba=true;
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $idUser = $user->getId();
            $id = $request->request->get('id');
            $post = $em->getRepository(Posts::class)->find($id);
            $likes = $post->getLikes();
            $usersLikes = explode(',', $likes);
            for($i = 0; $i < count($usersLikes);$i++){
                if($idUser == $usersLikes[$i])
                {
                    $nogustaba = false;
                    break;
                }
            }
            if($nogustaba){
                $likes .= $idUser.',';
                $post->setLikes($likes);
                $em->flush();
            }
            return new JsonResponse(['likes'=>$likes]);
        }else{
            throw new \Exception('¿Estas tratando de hackearme?');
        }
    }
    /**
     * @Route("/rss", name="rss")
     */
    public function rss(){
        $em = $this->getDoctrine()->getManager();
        $rss = $em->getRepository(Posts::class)->getRSS();
        return $this->render('posts/rss.html.twig', ['rss' => $rss]);
    }
}
