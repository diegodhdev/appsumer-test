<?php


namespace Base\ForeCasts\Forecast\Infrastructure;


use Base\Shared\Domain\DomainError;

class CityNotFound extends DomainError
{
    private string $cityName;

    public function __construct(string $cityName)
    {
        parent::__construct();
        $this->cityName = $cityName;
    }

    public function errorCode(): string
    {
        return 'city_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The city <%s> does not exist', $this->cityName);
    }
}
