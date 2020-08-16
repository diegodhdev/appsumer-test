<?php

namespace Tests\src\Logger;

use App\src\Logger\LegacyFilesystemLogger;

class FakeLegacyFilesystemFilesystemLogger implements LegacyFilesystemLogger
{

    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function logInfo(string $message, array $data)
    {
        if (!is_dir($this->path)) {
            mkdir($this->path, 0777, true);
        }

        file_put_contents($this->path . 'laravel.log', $message . ':' . serialize($data));
    }

}
