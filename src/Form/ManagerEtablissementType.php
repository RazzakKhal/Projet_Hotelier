<?php

namespace App\Form;

use App\Entity\Etablissement;
use App\Entity\Room;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ManagerEtablissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class)
            ->add('City', TextType::class)
            ->add('Adress', TextType::class)
            ->add('Description', TextareaType::class)
            ->add('Manager', EntityType::class, [

                'class' => User::class,
                'choice_label' => 'Name'
            ])
            ->add('Room', EntityType::class, [
                'class' => Room::class,
                'choice_label' => 'Title',
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}
