<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewProductController extends AbstractController
{

    /**
     *@Route("/view_post/{post_id}", name="view_post")
     *
     *
     * */
    public function index($post_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $post= $em->getRepository(Post::class)->findOneBy(['id'=>$post_id]);
//        dump($post);
        return $this->render('view_product/index.html.twig', [
            'post' => $post,
        ]);
    }
}
