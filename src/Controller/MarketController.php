<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarketController extends AbstractController
{
    /**
     * @Route("/market", name="market")
     *
     * */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findAll();
        return $this->render('market/index.html.twig', [
            'posts'=>$posts,
        ]);
    }
}
