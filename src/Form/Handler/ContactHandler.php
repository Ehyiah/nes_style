<?php

namespace App\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Mailer\Bridge\Sendgrid\Transport\SendgridSmtpTransport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

final class ContactHandler
{
    /** @var string */
    private $sendGrid;

    /** @var string */
    private $contactEmail;

    public function __construct(string $sendGrid, string $contactEmail)
    {
        $this->sendGrid = $sendGrid;
        $this->contactEmail = $contactEmail;
    }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $transport = new SendgridSmtpTransport($this->sendGrid);
            $mailer = new Mailer($transport);
            $email = new Email();
            $email->from($form->getData()['email']);
            $email->to($this->contactEmail);
            $email->text($form->getData()['message']);
            $email->subject($form->getData()['subject']);

            $mailer->send($email);

            return true;
        }

        return false;
    }
}
