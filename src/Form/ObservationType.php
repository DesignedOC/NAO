<?php

namespace App\Form;

use App\Entity\Observation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ObservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('latitude',NumberType::class, array('label' => 'Ajouter la latitude : '))
            ->add('longitude',NumberType::class, array('label' => 'Ajouter la longitude : '))
            ->add('picture',FileType::class, array('label' => 'Ajouter une photo de l\'oiseau : '))
            ->add('bird', TextType::class, array('label' => 'Nom de l\'espèce : '))
            ->add('description', TextareaType::class, array('label' => 'Ajouter une courte description : '))
            ->add('save', SubmitType::class, array('label' => 'Valider', 'attr' => array('class' => 'btn btn-primary mt-3')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Observation::class,
        ]);
    }
}
