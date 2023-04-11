<?php

namespace App\Form;

use App\Entity\Parking;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParkingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomParking',TextType::class, [
                'required' => false,
            ])
            ->add('logoParking',TextType::class, [
                'required' => false,
            ])
            ->add('capaciteParking',NumberType::class, [
                'required' => false,
            ])
            ->add('takenpParking',NumberType::class, [
                'required' => false,
            ])
            ->add('prixParking',NumberType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parking::class,
        ]);
    }
}
