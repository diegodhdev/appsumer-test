<?php

namespace Base\ForeCasts\Forecast\Infrastructure;

use Attogram\Weatherbit\Weatherbit;
use Attogram\Weatherbit\WeatherbitException;
use DateTime;

class WeatherBitForeCast implements ForeCast
{
    private Weatherbit $forecastService;

    public function __construct(Weatherbit $forecastService)
    {
        $this->forecastService = $forecastService;
    }

    public function getForecastByCity(string $city, string $countryCode): ForeCastResponse
    {
        try {
            $this->forecastService->setLocationByCity($city, $countryCode);
            $forecast = $this->forecastService->getCurrent();

            if ($this->isNotAValidCity($forecast)) {
                throw new CityNotFound($city);
            }

        } catch (WeatherbitException $error) {
            throw new ForecastServiceFailed($error->getMessage());
        }

        $city = reset($forecast)[0];

        return new WeatherbitForeCastResponse(
            $city['city_name'],
            $city['temp'],
            $city['rh'],
            $city['precip'],
            $city['wind_spd'],
            DateTime::createFromFormat('Y-m-d H:i', $city['ob_time'])
        );
    }

    public function isNotAValidCity($forecast): bool
    {
        return ($forecast['count'] == 0);
    }
}
