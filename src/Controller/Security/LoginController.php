<?php

namespace App\Controller\Security;

use App\Form\Security\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @return Response
     */
    public function login(Request $request): Response
    {
        $form = $this->createForm(LoginType::class)->handleRequest($request);

        return $this->render('security/login.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/logout", name="app_logout")
     *
     * @throws \Exception
     */
    public function logout()
    {
        throw new \Exception();
    }

}
