<?php

namespace App\Form;

use App\Entity\RechercheOffre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RechercheOffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pourcentage', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'pourcentage',
                    'class' => 'form-control bg-dark border-0'
                ]
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheOffre::class,
        ]);
    }
}
