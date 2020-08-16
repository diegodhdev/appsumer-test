<?php

namespace Tests\src\Logger;

use App\src\Logger\Logger;
use App\src\Logger\LegacyFilesystemLoggerFactory;
use Tests\TestCase;

class LegacyLoggerAdapterTest extends TestCase
{


    private string $fakeLegacyFilesystemTestFolder;
    /**
     * @var LegacyFilesystemLoggerFactory
     */
    private LegacyFilesystemLoggerFactory $legacyFilesystemLoggerFactory;
    private Logger $legacyFilesystemLogger;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakeLegacyFilesystemTestFolder = 'storage/logs/tests/legacy-filesystem/';
        $this->legacyFilesystemLoggerFactory  = (new LegacyFilesystemLoggerFactory(new FakeLegacyFilesystemFilesystemLogger($this->fakeLegacyFilesystemTestFolder)));
        $this->legacyFilesystemLogger         = $this->legacyFilesystemLoggerFactory->create();
    }

    /** @test */
    public function it_should_log_by_legacy_filesystem(): void
    {
        $logMessage = 'fake message';
        $logData    = [];

        $this->legacyFilesystemLogger->info($logMessage, $logData);
        $logContent = 'info: ' . $logMessage . ':' . serialize($logData);
        $infoLog    = file_get_contents($this->fakeLegacyFilesystemTestFolder . 'laravel.log');
        $this->assertEquals($logContent, $infoLog);
        $this->cleanFolder($this->fakeLegacyFilesystemTestFolder);

        $this->legacyFilesystemLogger->warning($logMessage, $logData);
        $logContentWarning = 'warning: ' . $logMessage . ':' . serialize($logData);
        $infoLogWarning    = file_get_contents($this->fakeLegacyFilesystemTestFolder . 'laravel.log');
        $this->assertEquals($logContentWarning, $infoLogWarning);
        $this->cleanFolder($this->fakeLegacyFilesystemTestFolder);

        $this->legacyFilesystemLogger->critical($logMessage, $logData);
        $logContentCritical = 'critical: ' . $logMessage . ':' . serialize($logData);
        $infoLogCritical    = file_get_contents($this->fakeLegacyFilesystemTestFolder . 'laravel.log');
        $this->assertEquals($logContentCritical, $infoLogCritical);
        $this->cleanFolder($this->fakeLegacyFilesystemTestFolder);

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
