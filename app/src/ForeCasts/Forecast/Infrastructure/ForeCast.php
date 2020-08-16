<?php

namespace Base\ForeCasts\Forecast\Infrastructure;

interface ForeCast
{
    public function getForecastByCity(string $city, string $countryCode): ForeCastResponse;
}
