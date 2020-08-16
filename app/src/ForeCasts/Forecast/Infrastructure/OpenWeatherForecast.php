<?php

namespace Base\ForeCasts\Forecast\Infrastructure;

use Cmfcmf\OpenWeatherMap\CurrentWeather;
use Gmopx\LaravelOWM\LaravelOWM;

class OpenWeatherForecast implements ForeCast
{
    private LaravelOWM $forecastService;

    public function __construct(LaravelOWM $forecastService)
    {
        $this->forecastService = $forecastService;
    }

    public function getForecastByCity(string $city, string $countryCode): ForeCastResponse
    {
        try {
            /** @CurrentWeather $forecast */
            $forecast = $this->forecastService->getCurrentWeather($city);

            if ($this->isNotAValidCity($forecast)) {
                throw new CityNotFound($city);
            }

        } catch (\Exception $error) {
            throw new ForecastServiceFailed($error->getMessage());
        }

        return new OpenWeatherForeCastResponse(
            $forecast->city->name,
            $forecast->temperature->getValue(),
            $forecast->humidity->getValue(),
            $forecast->precipitation->getValue(),
            $forecast->wind->speed,
            $forecast->lastUpdate
        );
    }

    /**
     * @param CurrentWeather $forecast
     *
     * @return bool
     */
    public function isNotAValidCity(CurrentWeather $forecast): bool
    {
        /** @CurrentWeather $forecast */
        return $forecast->city->id == 0;
    }
}
