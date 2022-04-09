<?php

namespace App\Controller;

use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/exercise', name: 'exercise_')]
class ExerciseController extends AbstractController
{
    #[Route('/maker', name: 'maker')]
    public function exerciseMaker(Request $request, EntityManagerInterface $manager): Response
    {
        $question = new Question;
        $startOfQuestionForm = $this->createFormBuilder($question)
                            ->add('title', TextType::class)
                            ->add('explanation', TextareaType::class)
                            ->add('answer', TextType::class)
                            ->getForm();

        //$media = new Media;
        //$mediaForm = $this->createFormBuilder($media)
        //                    ->

        



        return $this->render('exercise/maker.html.twig', [
            'startOfQuestionForm' => $startOfQuestionForm->createView(),
        ]);
    }

}
