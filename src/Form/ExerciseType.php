<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Exercise;
use App\Entity\Difficulty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'help' => 'Le titre doit comporter 50 maximum',
                'constraints' => [
                    new NotBlank([ /* Vérifie que le champs ne soit pas vide */
                        'message' => 'Veuillez renseigner le titre de l\'exercice',
                    ]),
                    new Length([ /* Vérifie la taille de la chaine de caractères */
                        'minMessage' => 'Votre Nom doit contenir au maximum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 50,
                    ]),
                ]
            ])

            ->add('category', EntityType::class, [
    
                    'label' => 'Category',
                    'attr' => ['class' => 'form-control'],
                    'placeholder' => 'Choisir une catégorie',
                    'class' => Category::class,
                    'choice_label' => 'name'
            ])
            
            ->add('difficulty', EntityType::class, [
    
                'label' => 'Difficulty',
                'attr' => ['class' => 'form-control'],
                'placeholder' => 'Choisir une difficulté',
                'class' => Difficulty::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}
