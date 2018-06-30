<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('obsEmail', CheckboxType::class, [
                    'label' => 'Souhaitez-vous recevoir un email lorsque votre observation est validée ?',
                    'required' => false
            ])
            ->add('dataShare', CheckboxType::class, [
                'label' => 'Est ce que vous nous autorisez à utiliser vos informations dans le cadre du programme de recherche ?',
                'required' => false
            ])
            ->add('newsletter', CheckboxType::class, [
                'label' => 'Souhaitez-vous recevoir notre newsletter ?',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
