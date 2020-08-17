<?php

namespace App\src\Logger;

use DateTimeImmutable;

/**
 * Logger: Logger generic class, define the generic actions for a logger. The class  which the rest of the Loggers needs to implement
 *
 * Contract to manage loggers instances
 * Contains the actions that a logger can perform
 *
 */
abstract class Logger
{
    /**
     * @var DateTimeImmutable Represent the exact moment where the log was triggered
     */
    protected DateTimeImmutable $occurredOn;

    public function __construct()
    {
        $this->occurredOn = new DateTimeImmutable();
    }

    /**
     * Trigger a info log record
     *
     * @param string $message messege to log
     * @param array  $data data structure to log
     */
    abstract public function info(string $message, array $data = []): void;

    /**
     * Trigger a warning log record
     *
     * @param string $message messege to log
     * @param array  $data data structure to log
     */
    abstract public function warning(string $message, array $data = []): void;

    /**
     * Trigger a critical log record
     *
     * @param string $message messege to log
     * @param array  $data data structure to log
     */
    abstract public function critical(string $message, array $data = []): void;
}
