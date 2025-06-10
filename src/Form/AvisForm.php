<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AvisForm extends AbstractType
{
 public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomClient', TextType::class, [
                'label' => 'Votre nom',
                'required' => true,
            ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu du chantier',
                'required' => true,
            ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Votre commentaire',
                'required' => true,
            ])
            ->add('note', ChoiceType::class, [
                'label' => 'Note',
                'choices' => [
                    '⭐' => 1,
                    '⭐⭐' => 2,
                    '⭐⭐⭐' => 3,
                    '⭐⭐⭐⭐' => 4,
                    '⭐⭐⭐⭐⭐' => 5,
                ],
                'expanded' => false,
                'multiple' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer mon avis',
                'attr' => ['class' => 'btn btn-primary mt-3']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
