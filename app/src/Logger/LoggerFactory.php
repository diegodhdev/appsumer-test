<?php

namespace App\src\Logger;

/**
 * Factory creation contract: Structure for  a logger creation instance
 *
 * Interface LoggerFactory
 * @package App\src\Logger
 */
interface LoggerFactory
{

    public function create(): Logger;

}
