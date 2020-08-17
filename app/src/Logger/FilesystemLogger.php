<?php

namespace App\src\Logger;

use App\src\Logger\Handlers\FilesystemHandler;

/**
 * FilesystemLogger implementation: Manage the actions which can be triggered for a Filesystem logger
 *
 * Class FilesystemLogger
 * @package App\src\Logger
 */
class FilesystemLogger extends Logger
{
    private string $path;

    /**
     * @var FilesystemHandler
     */
    private FilesystemHandler $handler;

    /**
     * @var FilesystemHandler $handler Handler to persist log on the filesystem
     * @var string $path Path where the log will be persisted
     */
    public function __construct(FilesystemHandler $handler, string $path)
    {
        parent::__construct();
        $this->handler = $handler;
        $this->path = $path;
    }

    public function info(string $message, array $data = []): void
    {
        $this->handler->persist($message,$data,$this->path.'info/', $this->occurredOn);
    }

    public function warning(string $message, array $data = []): void
    {
        $this->handler->persist($message,$data,$this->path.'warning/', $this->occurredOn);
    }

    public function critical(string $message, array $data = []): void
    {
        $this->handler->persist($message,$data,$this->path.'critical/', $this->occurredOn);
    }

}
