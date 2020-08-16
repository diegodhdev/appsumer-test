<?php

namespace Tests\src\Logger;

use App\src\Logger\EmailLoggerFactory;
use Tests\src\Logger\Handlers\FakeEmailSenderHandler;
use Tests\TestCase;

class EmailLoggerTest extends TestCase
{

    private string $fakeLoggerTestFolder;
    /**
     * @var EmailLoggerFactory
     */
    private EmailLoggerFactory $emailLoggerFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakeLoggerTestFolder = 'storage/logs/tests/fake-swift/';
        $this->emailLoggerFactory   =
            new EmailLoggerFactory(
                new FakeEmailSenderHandler(new FakeSwiftMailImplementation($this->fakeLoggerTestFolder))
            );
    }

    /** @test */
    public function it_should_log_by_email(): void
    {
        $loggerEmailAddress = 'admin@admin.com';
        $emailLogger        = $this->emailLoggerFactory->create($loggerEmailAddress);
        $logMessage         = 'fake message';
        $logData            = [];

        $emailLogger->info($logMessage, $logData);
        $logContent = 'info: ' . $logMessage . ':' . serialize($logData) . ':' . $loggerEmailAddress;
        $infoLog    = file_get_contents($this->fakeLoggerTestFolder . 'laravel.log');
        $this->assertEquals($logContent, $infoLog);
        $this->cleanFolder($this->fakeLoggerTestFolder);

        $emailLogger->warning($logMessage, $logData);
        $logContentWarning = 'warning: ' . $logMessage . ':' . serialize($logData) . ':' . $loggerEmailAddress;
        $infoLogWarning    = file_get_contents($this->fakeLoggerTestFolder . 'laravel.log');
        $this->assertEquals($logContentWarning, $infoLogWarning);
        $this->cleanFolder($this->fakeLoggerTestFolder);

        $emailLogger->critical($logMessage, $logData);
        $logContentCritical = 'critical: ' . $logMessage . ':' . serialize($logData) . ':' . $loggerEmailAddress;
        $infoLogCritical    = file_get_contents($this->fakeLoggerTestFolder . 'laravel.log');
        $this->assertEquals($logContentCritical, $infoLogCritical);
        $this->cleanFolder($this->fakeLoggerTestFolder);
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
