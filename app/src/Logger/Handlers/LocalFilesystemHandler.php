<?php

namespace App\src\Logger\Handlers;

use DateTimeImmutable;

/**
 * Filesystem local logger handler implementation: Manage how to persist logs in local filesystem
 *
 * Class LocalFilesystemHandler
 * @package App\src\Logger\Handlers
 */
class LocalFilesystemHandler implements FilesystemHandler
{

    public function persist(string $message, array $data, string $path, DateTimeImmutable $occurredOn)
    {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        file_put_contents($path . 'laravel.log', $message . ':' . serialize($data));
    }
}
