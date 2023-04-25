<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateReclamation')
            ->add('categorieReclamation', ChoiceType::class, [
                'choices' => [
                    'Evenement' => "Evenement",
                    'Film' => "Film"
                ]],)
            ->add('messageReclamation',TextType::class, [
                'required' => false,
            ])
            ->add('importanceReclamation', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('typeReclamation', ChoiceType::class, [
                'choices' => [
                    'Hygiène' => 'Hygiène',
                    'réservation' => 'réservation',
                    'staff' => 'staff',
                    'nourriture' => 'nourriture',
                ],
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
