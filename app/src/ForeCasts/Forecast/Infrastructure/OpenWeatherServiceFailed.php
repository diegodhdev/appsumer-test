<?php

namespace Base\ForeCasts\Forecast\Infrastructure;

use Base\Shared\Domain\DomainError;

class OpenWeatherServiceFailed extends DomainError
{

    public function __construct(string $message)
    {
        $this->message = $message;
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'open_weather_service_failed';
    }

    protected function errorMessage(): string
    {
        return sprintf('Open Weather Service failed: %s', $this->getMessage());
    }
}
