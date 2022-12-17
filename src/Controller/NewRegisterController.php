<?php

namespace App\Controller;

use App\Entity\Roles;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class NewRegisterController extends AbstractController
{
    /**
     * @Route("/register2", name="app_new_register")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository): Response
    {
            $username = $request->get('uname');
            $password = $request->get('pword');


            $user = new User();
            $user->setUsername($username);
            $user->setPassword($passwordEncoder->encodePassword($user,$password));
//            $user->setRoles(["ROLE_USER"]);
            $em = $this->getDoctrine()->getManager();

            $regularUser = new Roles();
            $regularUser->setName("Role User");
            $regularUser->setStatus(1);
            $regularUser->setRoleName("ROLE_USER");

            $em->persist($regularUser);
            $user->addRegularUser($regularUser);

            $em -> persist($user);
            $em->flush();





        return $this ->redirect($this->generateUrl('app_login'));
    }

}
