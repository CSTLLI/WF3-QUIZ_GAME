<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/exercise', name: 'exercise_')]
class ExerciseController extends AbstractController
{
    #[Route('/maker', name: 'maker')]
    public function exerciseMakerQuestion(Request $request, EntityManagerInterface $manager): Response
    {
        $question = new Question;
        $form = $this->createFormBuilder($question)
                            ->add('title', TextType::class)
                            ->add('explanation', TextareaType::class, ['required' => false])
                            ->add('content', FileType::class, ['mapped' => false,
                                                               'required' => false,
                                                               'attr' => ['accept' => 'image/*',
                                                                           'multiple' => 'multiple'
                                                                          ]])
                            ->add('answer1', TextType::class, ['mapped' => false,])
                            ->add('answer2', TextType::class, ['mapped' => false,])
                            ->add('answer3', TextType::class, ['mapped' => false, 'required' => false])
                            ->add('answer4', TextType::class, ['mapped' => false, 'required' => false])
                            ->add('answer5', TextType::class, ['mapped' => false, 'required' => false])
                            ->add('answer6', TextType::class, ['mapped' => false, 'required' => false])
                            ->add('isTrue1', CheckboxType::class, ['mapped' => false, 'required' => false])
                            ->add('isTrue2', CheckboxType::class, ['mapped' => false, 'required' => false])
                            ->add('isTrue3', CheckboxType::class, ['mapped' => false, 'required' => false])
                            ->add('isTrue4', CheckboxType::class, ['mapped' => false, 'required' => false])
                            ->add('isTrue5', CheckboxType::class, ['mapped' => false, 'required' => false])
                            ->add('isTrue6', CheckboxType::class, ['mapped' => false, 'required' => false])
                            ->getForm();

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {
        }

        return $this->renderForm('exercise/maker.html.twig', [
            'form' => $form,
        ]);
    }

    

}
