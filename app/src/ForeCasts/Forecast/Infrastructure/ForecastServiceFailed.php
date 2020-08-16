<?php

namespace Base\ForeCasts\Forecast\Infrastructure;

use Base\Shared\Domain\DomainError;

class ForecastServiceFailed extends DomainError
{

    public function __construct(string $message)

    {
        $this->message = $message;
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'forecast_service_failed';
    }

    protected function errorMessage(): string
    {
        return sprintf('Forecast Service failed: %s', $this->getMessage());
    }
}
