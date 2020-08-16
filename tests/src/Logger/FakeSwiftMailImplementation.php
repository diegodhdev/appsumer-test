<?php

namespace Tests\src\Logger;

class FakeSwiftMailImplementation
{

    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function sendEmail(string $message, array $data, string $to)
    {
        if (!is_dir($this->path)) {
            mkdir($this->path, 0777, true);
        }

        file_put_contents($this->path . 'laravel.log', $message . ':' . serialize($data) . ':' . $to);
    }
}
