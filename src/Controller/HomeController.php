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
    private $secretKey;

    public function __construct(string $google_secret_key)
    {
        $this->secretKey = $google_secret_key;
    }

    /**
     * @Route("/", name="home")
     */
    public function home(Request $request): Response
    {
        $form = $this->createForm(ContactType::class)->createView();
        $gcaptcha = new ReCaptcha($this->secretKey);
        $resp = $gcaptcha->verify($request->request->get('g-captcha-response'), $request->getClientIp());

        if (!$resp->isSuccess()) {
            $errors = $resp->getErrorCodes();
        }

        return $this->render('home.html.twig', ['form' => $form, 'error' => $errors ?? null]);
    }
}
