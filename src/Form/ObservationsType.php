<?php

namespace App\Form;

use App\Entity\Observations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('latitude')
            ->add('longitude')
            ->add('picture')
            ->add('bird')
            ->add('statut')
            ->add('description')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Observations::class,
        ]);
    }
}
