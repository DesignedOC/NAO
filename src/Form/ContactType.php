<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom',
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez saisir votre prénom. '
                    )))
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Nom',
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez saisir votre nom. '
                    )))
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Adresse email',
                'attr' => array(
                    'class' => 'col-md-8',
                    'placeholder' => 'contact@email.com'
                ),
                'constraints'     => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez saisir votre adresse email.'
                    )),
                    new Assert\Email([
                        'checkMX' => true,
                        'message' => 'Veuillez saisir une adresse email valide.'
                    ])
                ),
            ))
            ->add('subject', ChoiceType::class, array(
                'label' => 'Sujet',
                'placeholder' => 'Choisir...',
                'invalid_message' => 'Veuillez selectionner un sujet.',
                'attr' => array(
                    'class' => 'col-4'
                ),
                'choices'  => array(
                    'Problème technique' => 'Problème technique',
                    'Informations personnelles' => 'informations personnelles',
                    'Faites nous part de vos idées' => 'Faites nous part de vos idées'
                ),
                'constraints'     => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez sélectionner un sujet.'
                    ))),
            ))
            ->add('content', TextareaType::class, array(
                'label' => 'Message',
                'attr' => array(
                    'class' => 'col-12',
                    'rows' => 5
                ),
                'constraints' => array(
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez saisir votre message.'
                    ))
                )
            ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}