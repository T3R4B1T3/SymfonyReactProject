<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // pobierz błędy logowania, jeśli takie istnieją
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/login_check", name="app_login_check")
     */
    public function loginCheck(Request $request, ManagerRegistry $doctrine): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

        if (!$user) {
            throw new BadCredentialsException('Nieprawidłowe dane logowania');
        }

        $isPasswordValid = $this->get('security.password_encoder')
            ->isPasswordValid($user, $password);

        if ($isPasswordValid) {
            return $this->redirectToRoute('home');
        } else {
            throw new BadCredentialsException('Nieprawidłowe dane logowania');
        }
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        // kontroler nie robi niczego - jego celem jest zwrócenie odpowiedzi HTTP
    }
}
