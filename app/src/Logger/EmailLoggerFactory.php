<?php

namespace App\src\Logger;

use App\src\Logger\Handlers\EmailSenderHandler;

/**
 * Factory for handling the creation of EmailLogger instances
 *
 * Class EmailLoggerFactory
 * @package App\src\Logger
 */
class EmailLoggerFactory implements LoggerFactory
{

    /**
     * @var EmailSenderHandler
     */
    private EmailSenderHandler $handler;


    /**
     * @var EmailSenderHandler $handler Handler to send log by email
     */
    public function __construct(EmailSenderHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     *
     * Create an EmailLogger instance
     *
     * @param string $email_address Destiny email address for logging
     *
     * @return Logger
     */
    public function create(string $email_address = "admin@domain.com"): Logger
    {
        return new EmailLogger($this->handler, $email_address);
    }
}
