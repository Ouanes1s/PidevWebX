<?php

namespace App\Form;

use App\Entity\RechercheReservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RechercheReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email_res', TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'email_res',
                'class' => 'form-control bg-dark border-0'
            ]
        ]);
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheReservation::class,
        ]);
    }
}
