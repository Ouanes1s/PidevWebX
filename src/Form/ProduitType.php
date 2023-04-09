<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('barcode')
            ->add('productname')
            ->add('purchaseprice')
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'En stock' => 1,
                    'Hors stock' => 0,
                ],
                'expanded' => true,
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'btn btn-outline-dark m-2', 'style' => 'display: flex; gap: 40px;'],
            ])
            ->add('quantite')
            ->add('descriptionproduct')
            ->add('imageproduct', FileType::class, [
                'label' => 'Image du produit',
                'required' => false,
                'mapped' => false,
                'attr' => ['class' => 'form-control bg-dark'],
            ])
            //->add('insertiondate')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'form-select'
                ]
            ]);;;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
