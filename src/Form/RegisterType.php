<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Nom',
                'constraints' => new Regex('/\d/', 'Votre nom ne peut pas contenir de chiffre', null, false)
            ])#ajout du type et du label
            ->add('Firstname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => new Regex('/\d/', 'Votre nom ne peut pas contenir de chiffre', null, false)
            ])
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les 2 mots de passes doivent être identiques',
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Mot de passe', 'attr' => ['placeholder' => 'Confirmer le mot de passe']]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire'
            ])

            #pour ajouter un placeholder tu utilises l'option attr[ 'placeholer' => 'xxx']

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
