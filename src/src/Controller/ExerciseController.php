<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Form\ExerciseType;
use App\Repository\ExerciseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/* ---------------------------------------------------- Route EXERCISE (Principal) ---------------------------------------------------------*/

#[Route('/exercise', name: 'app_exercise_')]
class ExerciseController extends AbstractController
{

/* ---------------------------------------------------------- Route EXERCISE (Home) --------------------------------------------------------*/

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ExerciseRepository $exerciseRepository): Response
    {
        return $this->render('exercise/index.html.twig', [
            'exercises' => $exerciseRepository->findAll(),
        ]);
    }

/* ------------------------------------------------- Route EXERCISE (Création exercice) ----------------------------------------------------*/

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, ExerciseRepository $exerciseRepository): Response
    {
        $exercise = new Exercise();
        $form = $this->createForm(ExerciseType::class, $exercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exercise->setCategory($form->get('category')->getData());
            $exercise->setDifficulty($form->get('difficulty')->getData());
            $exerciseRepository->add($exercise);
            return $this->redirectToRoute('app_exercise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exercise/new.html.twig', [
            'exercise' => $exercise,
            'form' => $form,
        ]);
    }

/* --------------------------------------------------- Route EXERCISE (Voir exercice) ------------------------------------------------------*/

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Exercise $exercise): Response
    {
        return $this->render('exercise/show.html.twig', [
            'exercise' => $exercise,
        ]);
    }

/* ------------------------------------------------ Route EXERCISE (Modifiaction exercice) -------------------------------------------------*/

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exercise $exercise, ExerciseRepository $exerciseRepository): Response
    {
        $form = $this->createForm(ExerciseType::class, $exercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exerciseRepository->add($exercise);
            return $this->redirectToRoute('app_exercise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exercise/edit.html.twig', [
            'exercise' => $exercise,
            'form' => $form,
        ]);
    }

/* ------------------------------------------------ Route EXERCISE (Suppression exercice) --------------------------------------------------*/

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Exercise $exercise, ExerciseRepository $exerciseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exercise->getId(), $request->request->get('_token'))) {
            $exerciseRepository->remove($exercise);
        }

        return $this->redirectToRoute('app_exercise_index', [], Response::HTTP_SEE_OTHER);
    }
}
