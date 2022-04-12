<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/* Types */
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/* Contrôle */
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        /* ------------------------------------------- EMAIL ------------------------------------------*/
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([ /* Vérifie que le champs ne soit pas vide */
                        'message' => 'Veuillez renseigner votre Email',
                    ]),
                ]
            ])

        /* ------------------------------------------- NOM ------------------------------------------*/
            ->add('name', TextType::class, [
                'help' => 'Votre Prénom doit comporter 2 caractères minimum 50 maximum',
                'constraints' => [
                    new NotBlank([ /* Vérifie que le champs ne soit pas vide */
                        'message' => 'Veuillez renseigner votre Nom',
                    ]),
                    new Length([ /* Vérifie la taille de la chaine de caractères */
                        'min' => 2,
                        'minMessage' => 'Votre Nom doit contenir au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 50,
                    
                    ]),
                ]
            ])

        /* ------------------------------------------- PRENOM ------------------------------------------*/
            ->add('firstname', TextType::class, [
                'help' => 'Votre Prénom doit comporter 2 caractères minimum 50 maximum',
                'constraints' => [
                    new NotBlank([ /* Vérifie que le champs ne soit pas vide */
                        'message' => 'Veuillez renseigner votre Prénom',

                    ]),
                    new Length([ /* Vérifie la taille de la chaine de caractères */
                        'min' => 2,
                        'minMessage' => 'Votre Prénom doit contenir au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 50,
                    ]),
                ]
            ])

        /* ------------------------------------------- MOT DE PASSE ------------------------------------------*/
            ->add('plainPassword', PasswordType::class, [
                'help' => '8 caractères minimum (1Majuscule, 1Minuscule, 1Chiffre, 1Caractère Spéciale)',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([ /* Vérifie que le champs ne soit pas vide */
                        'message' => 'Veuillez renseigner votre Mot de passe',
                    ]),
                    new Length([ /* Vérifie la taille de la chaine de caractères */
                        'min' => 8,
                        'minMessage' => 'Votre Mot de passe doit contenir au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex([ /* Impose et vérifie que le mot de passe contient les éléments demandés */
                        'pattern' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/',
                        'message' => 'Le mot de passe doit obligatoirement comporter les éléments suivant : 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial',
                    ]),
                ],
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
