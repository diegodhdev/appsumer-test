<?php

declare(strict_types = 1);

namespace Tests\src\Logger;

use App\src\Logger\FilesystemLoggerFactory;
use App\src\Logger\Handlers\LocalFilesystemHandler;
use Tests\TestCase;

class FilesystemLoggerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_should_log_on_filesystem(): void
    {
        $filesystemLoggerFactory = (new FilesystemLoggerFactory(new LocalFilesystemHandler()));
        $testFolder              = 'storage/logs/tests/';
        $filesystemLogger        = $filesystemLoggerFactory->create($testFolder);

        $logMessage = 'fake message';
        $logData    = [];

        $filesystemLogger->info($logMessage, $logData);
        $filesystemLogger->warning($logMessage, $logData);
        $filesystemLogger->critical($logMessage, $logData);

        $logContent = $logMessage . ':' . serialize($logData);

        $infoLog     = file_get_contents($testFolder . 'info/laravel.log');
        $warningLog  = file_get_contents($testFolder . 'warning/laravel.log');
        $criticalLog = file_get_contents($testFolder . 'critical/laravel.log');

        $this->assertEquals($logContent, $infoLog);
        $this->assertEquals($logContent, $warningLog);
        $this->assertEquals($logContent, $criticalLog);

        $this->cleanFolder($testFolder);
    }

    private function cleanFolder($path)
    {
        $files = glob($path . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->cleanFolder($file) : unlink($file);
        }
        rmdir($path);
    }

}
