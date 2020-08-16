<?php

namespace App\src\Logger;

/**
 * Transform a Legacy filesystem logger in a filesystem logger
 *
 * Class LegacyLoggerAdapter
 * @package App\src\Logger
 */
class LegacyLoggerAdapter extends Logger
{

    /**
     * @var LegacyFilesystemLogger
     */
    private LegacyFilesystemLogger $logger;

    public function __construct(LegacyFilesystemLogger $logger)
    {
        parent::__construct();
        $this->logger = $logger;
    }

    public function info(string $message, array $data = []): void
    {
        $this->logger->logInfo('info: ' . $message, $data);
    }

    public function warning(string $message, array $data = []): void
    {
        $this->logger->logInfo('warning: ' . $message, $data);
    }

    public function critical(string $message, array $data = []): void
    {
        $this->logger->logInfo('critical: ' . $message, $data);
    }

}
