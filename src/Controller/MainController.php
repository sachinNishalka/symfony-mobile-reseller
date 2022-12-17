<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")

     */
    public function index()
    {
//        return new Response("<h1>This is the home page</h1>");
       return $this->render('/frontpage.html.twig');
    }


    /**
     * @Route("/anotherwel/{anothername?}", name="anotherwel")
     * @param Request $request
     * @return Response

     */
    public function anotherwel(Request $request)
    {
        $anothername = $request->get('anothername');
//        return new Response("<h1>This is the home page</h1>");
        return $this->render('home/welcome.html.twig',['name'=>$anothername]);
    }




    /**
     * @Route("/aboutus", name="aboutus")
     */
    public function aboutus()
    {
       return $this->render('about.html.twig');
    }

    /**
     * @Route("/welcome/{name?}", name="welcome")
     * @param Request $request
     * @return Response
     */
    public function welcome(Request $request)
    {
//        dump($request -> get("name"));
        $name = $request -> get("name");
        return new Response("<h1>Welcome {$name} </h1>");
    }



   /**
    * @Route ("/customCheck", name="custom_check")
    * @return  Response
    */
   public function custom_check(UserRepository $userRepository){
        $result = $userRepository ->lastrowID();

       return new Response($result[0][1]);
   }




}
