<?php

namespace App\Form;

use App\Entity\Etablissement;
use App\Entity\Reservation;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {#getForm recup le petit formulaire submit avec les données des champs, getParent pour récupérer le formulaire de base et y ajouter un champ
        $listener = function(FormEvent $event){
$form = $event->getForm();
$form->getParent()->add('Room', EntityType::class, [
    'placeholder' => 'Choisissez la suite désirée',
    'class' => Room::class,
    'choices' => $form->getData()->getRoom()
]);
        };
        $builder
            ->add('Start', DateType::class, [
'placeholder' => [
    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'
],
                'label' => 'Début',


            ])
            ->add('End', DateType::class, [
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'
                ],
                'label' => 'Fin'
            ])
            ->add('Etablissement', EntityType::class, [
                'placeholder' => 'Choisissez votre établissement',
                'class' => Etablissement::class,
                'choice_label' => 'Name',

            ])


            ->get('Etablissement')->addEventListener(FormEvents::POST_SUBMIT, $listener)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
