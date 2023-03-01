<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
class LoginController extends AbstractController
{
    private $csrfTokenManager;
    private $entityManager;

    public function __construct(CsrfTokenManagerInterface $csrfTokenManager, EntityManagerInterface $entityManager)
    {
        $this->csrfTokenManager = $csrfTokenManager;
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/login", name="app_login")
     */
    public function login(Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $csrfToken = $request->request->get('_csrf_token');

        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('authenticate', $csrfToken))) {
            throw new BadCredentialsException('Invalid CSRF token.');
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

        if (!$user) {
            throw $this->createNotFoundException();
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new BadCredentialsException();
        }

        $this->get('security.token_storage')->setToken(null);

        return new JsonResponse(['message' => 'Logged in successfully.']);
    }
}
