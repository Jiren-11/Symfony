<?php

namespace App\Form;

use App\Entity\Devis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('user',
            null,
            [
                'placeholder' => 'Sélectionnez un client',
                'attr' => ['class' => 'haie-select'],
                'label' => 'Client',
            ])
            
            ->add('haie', 
            null,
            [
                'placeholder' => 'Sélectionnez une haie',
                'attr' => ['class' => 'haie-select'],
                'label' => 'Haie',
            ])

            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de création',
                'attr' => ['class' => 'js-datepicker'],
            ])

            ->add('hauteur')
            ->add('longueur')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
