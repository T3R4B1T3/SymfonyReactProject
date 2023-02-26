<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // pobierz błędy logowania, jeśli takie istnieją
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/login_check", name="app_login_check")
     */
    public function loginCheck(Request $request)
    {
        // kontroler nie robi niczego - jego celem jest zwrócenie odpowiedzi HTTP
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        // kontroler nie robi niczego - jego celem jest zwrócenie odpowiedzi HTTP
    }
}
