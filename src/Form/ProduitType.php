<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Offre;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;


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

            ->add('photo', FileType::class, [
                'label' => 'Image du produit (Image file seulement)',

                // unmapped means that this field (photo) is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            /*
            ->add('photo', FileType::class, [
                'label' => 'Image du produit',
                'required' => false,
                'mapped' => false,
                'attr' => ['class' => 'form-control bg-dark'],
            ])
*/
            //->add('insertiondate')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            ->add('offre', EntityType::class, [
                'class' => Offre::class,
                'choice_label' => 'pourcentage',
                'attr' => [
                    'class' => 'form-select',
                    'multiple aria-label' => "multiple select example"
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
