<?php

namespace App\src\Logger;

use App\src\Logger\Handlers\LocalFilesystemHandler;
use App\src\Logger\Handlers\SwiftMailEmailSenderHandler;
use App\src\Logger\Handlers\SwiftMailImplementation;

/**
 * Methods to build loggers. Used as a shortcut method to create logger instances
 *
 * Trait LoggerTrait
 * @package App\src\Logger
 */
trait LoggerTrait
{
    public function createFilesystemLogger(): Logger
    {
        return (new FilesystemLoggerFactory(new LocalFilesystemHandler()))->create();
    }

    public function createLegacyFilesystemLogger(): Logger
    {
        return (new LegacyFilesystemLoggerFactory(new LocalLegacyFilesystemLogger()))->create();
    }

    public function createEmailLogger(): Logger
    {
        return (new EmailLoggerFactory($this->getEmailLoggerHandler()))->create();
    }

    /**
     * @return SwiftMailEmailSenderHandler
     */
    public function getEmailLoggerHandler(): SwiftMailEmailSenderHandler
    {
        $emailService = new SwiftMailImplementation();

        return new SwiftMailEmailSenderHandler($emailService);
    }
}
