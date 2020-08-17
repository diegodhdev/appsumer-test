<?php


namespace App\src\Logger;

/**
 * Contract for legacy filesystem logger implementations
 *
 * Interface LegacyFilesystemLogger
 * @package App\src\Logger
 */
interface LegacyFilesystemLogger
{
    public function logInfo(string $message, array $data);
}
