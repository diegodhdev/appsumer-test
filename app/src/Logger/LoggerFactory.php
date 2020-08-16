<?php

namespace App\src\Logger;

/**
 * Factory creation contract
 *
 * Interface LoggerFactory
 * @package App\src\Logger
 */
interface LoggerFactory
{

    public function create(): Logger;

}
