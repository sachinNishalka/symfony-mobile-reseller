<?php

namespace App\Controller;

use     App\Entity\Post;
use App\Entity\User;
use App\Form\DataViewType;
use App\Form\PostType;
use App\Form\UpdateFormType;
use App\Repository\PostRepository;
use App\services\fileUploader;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

// making a super route

/**
 * @Route("/post", name="post.")
 */


class PostController extends AbstractController
{
//    when taking the data out use the repository


    /**
     * @Route("/post", name="app_post")
     */
    public function index(PostRepository $postRepository, UserInterface $user, ValidatorInterface $validator): Response
    {
        $em=$this->getDoctrine()->getManager();
        $posts =$em->getRepository(Post::class) ->findBy(['user'=>$user]);
//        dump($posts);

        $username = $user->getUsername();

        return $this->render('post/index.html.twig', [
            'posts' => $posts, "user" => $username
        ]);
    }
    /**
     * @Route("/create", name="create_post")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request, UserInterface $user){
        $post = new Post();
        $userID = $user;



        $form = $this->createForm(PostType::class,$post);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $fileList =  array();
            /** @var UploadedFile $file*/
            $file1 = $request -> files -> get('post')['image1'];
            $file2 = $request -> files -> get('post')['image2'];
            $file3 = $request -> files -> get('post')['image3'];
            $file4 = $request -> files -> get('post')['image4'];





            if ($file1){
                $filename = md5(uniqid()) . "." .$file1->guessClientExtension();
                $file1-> move(
                    $this-> getParameter('uploads_dir'),$filename
                );
                $post->setImage1($filename);

            }
            if ($file2){
                $filename = md5(uniqid()) . "." .$file2->guessClientExtension();
                $file2-> move(
                    $this-> getParameter('uploads_dir'),$filename
                );
                $post->setImage2($filename);

            }
            if ($file3){
                $filename = md5(uniqid()) . "." .$file3->guessClientExtension();
                $file3-> move(
                    $this-> getParameter('uploads_dir'),$filename
                );
                $post->setImage3($filename);

            }
            if ($file4){
                $filename = md5(uniqid()) . "." .$file4->guessClientExtension();
                $file4-> move(
                    $this-> getParameter('uploads_dir'),$filename
                );
                $post->setImage4($filename);

            }





            $post->setUser($userID);

            $em -> persist($post);

            $em -> flush();
            $this -> addFlash('success', 'Post was created');
            $username = $user->getUsername();
            return $this->redirect($this->generateUrl('post.app_post',['user'=>$username]));
        }





//        $post ->setTitle("This is going to be a title");

//        entity manager
//        connects and talk to the database
//        $em = $this->getDoctrine()->getManager();
//        $em -> persist($post);
//        $em -> flush();
        $username = $user->getUsername();
        return $this->render('post/create.html.twig',['form'=>$form->createView(),'user'=>$username]);


    }

    /**
     * @Route ("/update/{id}", name="post_update")
     * @param Request $request
     * @return Response
     */

    public function update($id, Request $request, UserInterface $user){
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->find($id);
        $oldImage1 = $post->getImage1();
        $oldImage2 = $post->getImage2();
        $oldImage3 = $post->getImage3();
        $oldImage4 = $post->getImage4();



//        dump($oldImage);

//        dump($form);

        $form = $this->createForm(UpdateFormType::class,$post);

        $form ->handleRequest($request);
//        dump($form);
        if ($form->isSubmitted()){
            /** @var  UploadedFile $file */
//            dump($request->files);
            $file1 = $request -> files -> get('update_form')['image1'];
            $file2 = $request -> files -> get('update_form')['image2'];
            $file3 = $request -> files -> get('update_form')['image3'];
            $file4 = $request -> files -> get('update_form')['image4'];

//            dump($file);
            if ($file1){
                $filename = md5(uniqid()) . "." . $file1->guessClientExtension();
                $file1->move(
                    $this-> getParameter('uploads_dir'),$filename
                );
                $post->setImage1($filename);
                $filesystem = new Filesystem();
                $filesystem->remove('./uploads/'.$oldImage1);

            }
            if ($file2){
                $filename = md5(uniqid()) . "." . $file2->guessClientExtension();
                $file2->move(
                    $this-> getParameter('uploads_dir'),$filename
                );
                $post->setImage2($filename);
                $filesystem = new Filesystem();
                $filesystem->remove('./uploads/'.$oldImage2);

            }
            if ($file3){
                $filename = md5(uniqid()) . "." . $file3->guessClientExtension();
                $file3->move(
                    $this-> getParameter('uploads_dir'),$filename
                );
                $post->setImage3($filename);
                $filesystem = new Filesystem();
                $filesystem->remove('./uploads/'.$oldImage3);

            }

            if ($file4){
                $filename = md5(uniqid()) . "." . $file4->guessClientExtension();
                $file4->move(
                    $this-> getParameter('uploads_dir'),$filename
                );
                $post->setImage4($filename);
                $filesystem = new Filesystem();
                $filesystem->remove('./uploads/'.$oldImage4);

            }


            $em -> persist($post);

            $em -> flush();
            $this -> addFlash('success', 'Post was updated');
            return $this->redirect($this->generateUrl('post.app_post', ["user"=>$user->getUsername()]));
        }



        $username = $user->getUsername();
        return $this->render('post/update.html.twig',['form'=>$form->createView(),'posts'=>$post, "user"=>$username]);
    }












    /**
     *@Route ("/show/{id}", name="show")
     *@param Post $post
     *@return Response
     */



    public function show($id, PostRepository $postRepository, UserInterface $user){
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->find($id);
//        dump($post);

        $form = $this->createForm(DataViewType::class,$post);
        $username = $user->getUsername();

        return $this -> render('post/show.html.twig',['form'=>$form->createView(),'posts'=>$post, 'user'=>$username]);
    }

    /**
     * @Route ("/delete/{id}", name="delete")
     * @return Response
     * */
    public function remove($id, PostRepository $postRepository){

        $em = $this->getDoctrine()->getManager();
        $post = $postRepository -> find($id);
        $em->remove($post);
        $em->flush();

        $filesystem = new Filesystem();
        $filesystem->remove('./uploads/'.$post->getImage1());
        $filesystem->remove('./uploads/'.$post->getImage2());
        $filesystem->remove('./uploads/'.$post->getImage3());
        $filesystem->remove('./uploads/'.$post->getImage4());


        $this -> addFlash('success', 'Post was removed');
        return $this->redirect($this->generateUrl('post.app_post'));
    }

}
