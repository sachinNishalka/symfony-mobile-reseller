<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegularUserController extends AbstractController
{
    /**
     * @Route("/client", name="app_regular_user")
     */
    public function index(): Response
    {
        return $this->render('regular_user/index.html.twig', [
            'controller_name' => 'RegularUserController',
        ]);
    }
}
