<?php

namespace App\Controller;

use App\Entity\Exercise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ExerciseController extends AbstractController
{
    /**
     * @Route("/add-exercise", name="add_exercise", methods={"POST"})
     */
    public function addExercise(Request $request, EntityManagerInterface $entityManager)
    {
        $muscleGroup = $request->request->get('muscleGroup') ?? '';
        $exerciseName = $request->request->get('exerciseName') ?? '';

        $exercise = new Exercise();
        $exercise->setMuscleGroup($muscleGroup);
        $exercise->setName($exerciseName);

        $entityManager->persist($exercise);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Exercise added successfully!']);
    }
}
