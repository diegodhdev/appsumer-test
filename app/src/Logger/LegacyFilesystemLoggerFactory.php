<?php

namespace App\src\Logger;

/**
 * Create legacy filesystem logger instances
 *
 * Class LegacyFilesystemLoggerFactory
 * @package App\src\Logger
 */
class LegacyFilesystemLoggerFactory implements LoggerFactory
{

    /**
     * @var LegacyFilesystemLogger Contract for legacy filesystem logger
     */
    private LegacyFilesystemLogger $logger;

    public function __construct(LegacyFilesystemLogger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Creation method
     *
     * @return Logger
     */
    public function create(): Logger
    {
        return new LegacyLoggerAdapter($this->logger);
    }
}
