<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_user')
            ->add('prenom_user')
            ->add('cin_user')
            ->add('email')
            ->add('roles', ChoiceType::class,[
                'multiple'=>true,
                'expanded'=>false,
                'choices'=> [
                'Agent de Reservation'=>'Agent de Reservation',
                'Agent de Stock'=>'Agent de Stock',
                'Agent de reclamation'=>'Agent de reclamation',
                'Agent de Parking'=>'Agent de Parking',
                'Agent de Films'=>'Agent de Films',
            ],])
            ->add('password',PasswordType::class)
            /*,RepeatedType::class,[
                'type'=>PasswordType::class,
                'first_options'=>['label'=>'Mot de passe'],
                'second_options'=>['label'=>'Confirmer mot de passe']
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
