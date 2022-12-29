<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ShowPostsController extends AbstractController
{
    /**
     *@Route("/show_posts/{category_id}", name="show_posts")
     *
     *
     * */
    public function index($category_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findBy(['category'=>$category_id]);
        $category = $em->getRepository(Category::class)->findBy(['id'=>$category_id]);
//      dump($category);
        return $this->render('show_posts/index.html.twig',['posts'=>$posts, 'category'=>$category[0]]);
    }
}
