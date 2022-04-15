<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prenom'
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Email'
            ])

            ->add('subject', ChoiceType::class, [
                'choices'  => [
                    'Poser une réclamation' => 'réclamation',
                    'Commander un service supplémentaire' => 'service',
                    'En savoir plus sur une suite' => 'suite',
                    'Signaler un problème sur l\'application' => 'application'
                ],
                'label' => 'Sujet'
            ])
            ->add('object', TextareaType::class, [
                'label' => 'Objet'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
