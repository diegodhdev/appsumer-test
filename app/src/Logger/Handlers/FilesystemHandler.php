<?php

namespace App\src\Logger\Handlers;

use DateTimeImmutable;

/**
 * Log filesystem handler contract
 *
 * Interface EmailSenderHandler
 * @package App\src\Logger\Handlers
 */
interface FilesystemHandler
{
    public function persist(string $message, array $data, string $path, DateTimeImmutable $occurredOn);

}
