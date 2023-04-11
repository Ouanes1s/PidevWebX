<?php

namespace App\Form;

use App\Entity\RechercheBlog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RechercheBlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email_blg', TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'email_blg',
                'class' => 'form-control bg-dark border-0'
            ]
        ]);;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheBlog::class,
        ]);
    }
}
