<?php

namespace App\Form;

use App\Entity\Agent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('date_contract')
            ->add('password',PasswordType::class)
            ->add('nom_user')
            ->add('prenom_user')
            ->add('cin_user')
            ->add('salaire')
            ->add('type_A', ChoiceType::class,[
                'multiple'=>true,
                'expanded'=>false,
                'choices'=> [
                'Agent de reservation'=>'Agent de reservation',
                'Agent de Stock'=>'Agent de Stock',
                'Agent de reclamation'=>'Agent de reclamation',
                'Agent de Cinemas'=>'Agent de Cinemas',
                'Agent d"evenements'=>'Agent d"evenements',
            ],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agent::class,
        ]);
    }
}
