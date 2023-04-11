<?php

namespace App\Form;

use App\Entity\OffreR;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreRType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
        ->add('nomfilm_offr')
        ->add('contenu_offr')
        ->add('datedebut_offr')
        ->add('datefin_offr')
        ->add('code_offr')
     
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OffreR::class,
        ]);
    }
}
