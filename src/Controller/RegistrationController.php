<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
/**
* @Route("/register", name="registration")
*/
public function register(Request $request, ValidatorInterface $validator,ManagerRegistry $doctrine): Response
{
$data = json_decode($request->getContent(), true);

// Pobranie nazwy użytkownika i hasła z żądania
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

// Walidacja danych
$violations = $validator->validate($username, [
new NotBlank(),
new Length(['min' => 2])
]);
$violations->addAll($validator->validate($password, [
new NotBlank(),
new Length(['min' => 2])
]));

if (count($violations) > 0) {
// Jeśli wystąpiły błędy walidacji, zwracamy odpowiedź z kodem HTTP 400 Bad Request
return new JsonResponse(['message' => 'Błędne dane rejestracyjne'], Response::HTTP_BAD_REQUEST);
}

// Stworzenie encji użytkownika
$user = new User();
$user->setUsername($username);
$user->setPassword(password_hash($password, PASSWORD_DEFAULT));

// Zapisanie encji użytkownika do bazy danych za pomocą Doctrine
$entityManager = $doctrine->getManager();
$entityManager->persist($user);
$entityManager->flush();

// Zwracamy odpowiedź z kodem HTTP 201 Created
return new JsonResponse(['message' => 'Użytkownik został zarejestrowany'], Response::HTTP_CREATED);
}
}
