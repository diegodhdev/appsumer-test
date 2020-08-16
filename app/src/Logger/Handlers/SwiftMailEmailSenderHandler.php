<?php

namespace App\src\Logger\Handlers;


use DateTimeImmutable;

/**
 * SwiftMail logger sender handler implementation
 *
 * Class LocalFilesystemHandler
 * @package App\src\Logger\Handlers
 */
class SwiftMailEmailSenderHandler implements EmailSenderHandler
{
    private SwiftMailImplementation $mailer;

    public function __construct(SwiftMailImplementation $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param string            $message    Message to log
     * @param array             $data       Data to log
     * @param string            $to         Destiny email address
     * @param DateTimeImmutable $occurredOn Time when the log was triggered
     */
    public function send(string $message, array $data, string $to, DateTimeImmutable $occurredOn)
    {
//        $this->mailer->sendEmail($message...);
    }

}
