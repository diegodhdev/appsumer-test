<?php

namespace App\src\Logger;

use App\src\Logger\Handlers\EmailSenderHandler;

/**
 * EmailLogger implementation
 *
 * Class EmailLogger
 * @package App\src\Logger
 */
class EmailLogger extends Logger
{

    /**
     * Handler to send emails
     *
     * @var EmailSenderHandler
     */
    private EmailSenderHandler $handler;

    /**
     * @var string Destiny email address for logs
     */
    private string $to;

    public function __construct(EmailSenderHandler $handler, string $to)
    {
        parent::__construct();
        $this->handler = $handler;
        $this->to      = $to;
    }

    public function info(string $message, array $data = []): void
    {
        $this->handler->send('info: '.$message, $data, $this->to, $this->occurredOn);
    }

    public function warning(string $message, array $data = []): void
    {
        $this->handler->send('warning: '.$message, $data, $this->to, $this->occurredOn);
    }

    public function critical(string $message, array $data = []): void
    {
        $this->handler->send('critical: '.$message, $data, $this->to, $this->occurredOn);
    }

}
