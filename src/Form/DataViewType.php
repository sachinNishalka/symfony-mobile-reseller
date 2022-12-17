<?php

namespace App\Form;

use App\Entity\Post;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class DataViewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model',TextType::class,['attr'=>['disabled'=>'true']])
            ->add('description',TextType::class,['attr'=>['disabled'=>'true']])
            ->add('price',TextType::class,['attr'=>['disabled'=>'true']])
            ->add('city',TextType::class,['attr'=>['disabled'=>'true']])
            ->add('ContactNumber',TextType::class,['attr'=>['disabled'=>'true']])
            ->add('category',TextType::class,['attr'=>['disabled'=>'true']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
