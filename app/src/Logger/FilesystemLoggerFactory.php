<?php

declare(strict_types=1);

namespace App\src\Logger;

use App\src\Logger\Handlers\FilesystemHandler;

/**
 * Factory for handling the creation of FilesystemLogger instances
 *
 * Class FilesystemLoggerFactory
 * @package App\src\Logger
 */
class FilesystemLoggerFactory implements LoggerFactory
{

    /**
     * @var FilesystemHandler
     */
    private FilesystemHandler $handler;

    /**
     * @var FilesystemHandler $handler Handler to persist log on filesystem
     */
    public function __construct(FilesystemHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     *
     * Create a FilesystemLogger instance
     *
     * @param string $path Path for logging on filesystem
     *
     * @return Logger
     */
    public function create(string $path = 'path/to/some/folder/'): Logger
    {
        return new FilesystemLogger($this->handler, $path);
    }

}
