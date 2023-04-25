<?php

namespace App\Form;

use App\Entity\Parking;
use Doctrine\DBAL\Types\FloatType;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ParkingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomParking',TextType::class, [
                'required' => false,
            ])
            ->add('imageFile',VichImageType::class)
            ->add('capaciteParking',NumberType::class, [
                'required' => false,
            ])
            ->add('takenpParking',NumberType::class, [
                'required' => false,
            ])
            ->add('prixParking',NumberType::class, [
                'required' => false,
            ])
            /*->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'parking',
            ])*/
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parking::class,
        ]);
    }
}
