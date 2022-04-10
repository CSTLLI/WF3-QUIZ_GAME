<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('name')
            ->add('firstname')
            ->add('roles', ChoiceType::class, [
                'placeholder' => 'Veuillez choisir un role',
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => [
                    'FORMATEUR' => 'ROLE_FORMATEUR',
                    'APPRENANT' => 'ROLE_APPRENANT',
                    'USER' => 'ROLE_USER'
                ]
            ])
        ;

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                // Passage de type array en string
                function ($rolesArray) {
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                // Passage de type string en type array
                function ($rolesString) {
                    return [$rolesString];
                }
            ));  
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
