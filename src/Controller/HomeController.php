<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Form\Handler\ContactHandler;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    private $secretKey;

    /**
     * @var ContactHandler
     */
    private $handler;

    public function __construct(string $google_secret_key, ContactHandler $handler)
    {
        $this->secretKey = $google_secret_key;
        $this->handler = $handler;
    }

    /**
     * @Route("/", name="home")
     */
    public function home(Request $request): Response
    {
        $form = $this->createForm(ContactType::class)->handleRequest($request);
//        $gcaptcha = new ReCaptcha($this->secretKey);
//        $resp = $gcaptcha->verify($request->request->get('g-captcha-response'), $request->getClientIp());
//
//        if (!$resp->isSuccess()) {
//            $errors = $resp->getErrorCodes();
//        }

        if ($this->handler->handle($form)) {
//            dd($form);
        }

        return $this->render('home.html.twig', ['form' => $form->createView(), 'error' => $errors ?? null]);
    }
}
