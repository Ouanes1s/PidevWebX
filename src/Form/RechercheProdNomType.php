<?php

namespace App\Form;

use App\Entity\RechercheProduit_Nom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RechercheProdNomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productname', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'ProductName',
                    'class' => 'form-control bg-dark border-0'
                ]
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheProduit_Nom::class,
        ]);
    }
}
