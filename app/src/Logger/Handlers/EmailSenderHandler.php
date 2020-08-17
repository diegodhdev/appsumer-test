<?php

namespace App\src\Logger\Handlers;

use DateTimeImmutable;

/**
 * Log email sender handler contract: Manage the structure for a specific email handler
 *
 * Interface EmailSenderHandler
 * @package App\src\Logger\Handlers
 */
interface EmailSenderHandler
{
    public function send(string $message, array $data, string $to, DateTimeImmutable $occurredOn);

}
