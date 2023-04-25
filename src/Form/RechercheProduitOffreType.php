<?php

namespace App\Form;

use App\Entity\Offre;
use App\Entity\RechercheProduit_Offre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheProduitOffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('offre', EntityType::class, [
                'class' => Offre::class,
                'choice_label' => 'pourcentage',
                'label' => 'Offre'
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheProduit_Offre::class,
        ]);
    }
}
