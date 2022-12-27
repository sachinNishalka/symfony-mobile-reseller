<?php

namespace App\Controller;

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
        return $this->render('market/index.html.twig', [
            'controller_name' => 'MarketController',
        ]);
    }
}
