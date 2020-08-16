<?php

namespace Tests\src\Logger\Handlers;

use App\src\Logger\Handlers\EmailSenderHandler;
use DateTimeImmutable;
use Tests\src\Logger\FakeSwiftMailImplementation;

class FakeEmailSenderHandler implements EmailSenderHandler
{
    private FakeSwiftMailImplementation $mailer;

    public function __construct(FakeSwiftMailImplementation $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(string $message, array $data, string $to, DateTimeImmutable $occurredOn)
    {
        $this->mailer->sendEmail($message, $data, $to);
    }

}
