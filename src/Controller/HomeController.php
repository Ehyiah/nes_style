<?php

namespace App\Controller;

use App\Form\ContactType;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request): Response
    {
        $form = $this->createForm(ContactType::class)->createView();
        $gcaptcha = new ReCaptcha();
        $resp = $gcaptcha->verify($request->request->get('g-captcha-response'), $request->getClientIp());

        if (!$resp->isSuccess()) {
            $message = "The reCAPTCHA wasn\'t entered correctly. Go back and try it again." . "(reCAPTCHA said: " . $resp->error . ")";
        }

        return $this->render('home.html.twig', ['form' => $form]);
    }
}
