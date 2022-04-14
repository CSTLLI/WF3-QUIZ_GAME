<?php

namespace App\Controller;

use App\Entity\Difficulty;
use App\Form\DifficultyType;
use App\Repository\DifficultyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/* --------------------------------------------------- Route DIFFICULTY (Principal)  ---------------------------------------------------------*/

#[Route('/difficulty', name: 'app_difficulty_')]
class DifficultyController extends AbstractController
{

/* ---------------------------------------------------------- Route DIFFICULTY (Home) --------------------------------------------------------*/

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(DifficultyRepository $difficultyRepository): Response
    {
        return $this->render('difficulty/index.html.twig', [
            'difficulties' => $difficultyRepository->findAll(),
        ]);
    }

/* ------------------------------------------------- Route DIFFICULTY (Création difficulté) --------------------------------------------------*/

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, DifficultyRepository $difficultyRepository): Response
    {
        $difficulty = new Difficulty();
        $form = $this->createForm(DifficultyType::class, $difficulty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $difficultyRepository->add($difficulty);
            return $this->redirectToRoute('app_difficulty_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('difficulty/new.html.twig', [
            'difficulty' => $difficulty,
            'form' => $form,
        ]);
    }

/* --------------------------------------------------- Route DIFFICULTY (Voir difficulté) ----------------------------------------------------*/

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Difficulty $difficulty): Response
    {
        return $this->render('difficulty/show.html.twig', [
            'difficulty' => $difficulty,
        ]);
    }

/* ------------------------------------------------ Route DIFFICULTY (Modifiaction difficulté) -----------------------------------------------*/

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Difficulty $difficulty, DifficultyRepository $difficultyRepository): Response
    {
        $form = $this->createForm(DifficultyType::class, $difficulty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $difficultyRepository->add($difficulty);
            return $this->redirectToRoute('app_difficulty_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('difficulty/edit.html.twig', [
            'difficulty' => $difficulty,
            'form' => $form,
        ]);
    }

/* ------------------------------------------------ Route DIFFICULTY (Suppression difficulté) ------------------------------------------------*/

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Difficulty $difficulty, DifficultyRepository $difficultyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$difficulty->getId(), $request->request->get('_token'))) {
            $difficultyRepository->remove($difficulty);
        }

        return $this->redirectToRoute('app_difficulty_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
