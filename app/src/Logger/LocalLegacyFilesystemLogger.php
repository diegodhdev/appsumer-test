<?php

namespace App\src\Logger;

/**
 * Legacy Class for  logging in local filesystem
 *
 * Class LocalLegacyFilesystemFilesystemLogger
 * @package App\src\Logger
 */
class LocalLegacyFilesystemLogger implements LegacyFilesystemLogger
{
    /**
     * Legacy method to log messages and data on filesystem
     *
     * @param string $message Message to log
     * @param array  $data Data lo log
     */
    public function logInfo(string $message, array $data)
    {
        //Logging
    }

}
