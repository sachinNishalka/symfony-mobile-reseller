<?php

namespace App\Controller;

use App\Entity\Roles;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use function Sodium\add;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this -> createFormBuilder()
            ->add('username')
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('save',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary float-end'
                ]
            ])
            ->getForm();

        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $data = $form ->getData();

//            dump($data);

            $regularUser = new Roles();
            $regularUser->setName("Role User");
            $regularUser->setStatus(1);
            $regularUser->setRoleName("ROLE_USER");
            $em = $this->getDoctrine()->getManager();
            $em->persist($regularUser);

            $user = new User();
            $user->setUsername($data['username']);
            $user->setPassword($passwordEncoder->encodePassword($user,$data['password']));
            $user->addRegularUser($regularUser);
            $want =$em -> persist($user);
//            dump($want);
            $em->flush();

            return $this->redirect($this->generateUrl('app_login'));
        }
        return $this->render('registration/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
