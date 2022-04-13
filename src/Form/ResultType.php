<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Result;
use App\Entity\Exercise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ResultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('grades')
            ->add('exercise', EntityType::class, [
    
                'label' => 'Exercise',
                'attr' => ['class' => 'form-control'],
                'placeholder' => 'Choisir un exercice',
                'class' => Exercise::class,
                'choice_label' => 'title'
        ])
            ->add('user', EntityType::class, [
    
                'label' => 'User',
                'attr' => ['class' => 'form-control'],
                'placeholder' => 'Choisir un apprenant',
                'class' => User::class,
                'choice_label' => 'name'
        ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Result::class,
        ]);
    }
}
