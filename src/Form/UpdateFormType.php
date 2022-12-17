<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model')
            ->add('description',TextareaType::class,[
                'attr'=>[
                    'maxlength'=>1000
                ]
            ])
            ->add('price')
            ->add('city')
            ->add('ContactNumber')

            ->add('image1',FileType::class,[
                'mapped'=> false,
                'attr'=>['required'=>false]
            ])->setRequired(false)
            ->add('image2',FileType::class,[
                'mapped'=> false,
                'attr'=>['required'=>false]
            ])->setRequired(false)
            ->add('image3',FileType::class,[
                'mapped'=> false,
                'attr'=>['required'=>false]
            ])->setRequired(false)
            ->add('image4',FileType::class,[
                'mapped'=> false,
                'attr'=>['required'=>false]
            ])->setRequired(false)


            ->add('category', EntityType::class,[
                'class'=> Category::class
            ])
            ->add('Update',SubmitType::class,[
                'attr'=>[
                    'class' =>'btn btn-success float-end'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
