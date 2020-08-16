<?php

namespace App\Providers;

use Attogram\Weatherbit\Weatherbit;
use Base\ForeCasts\Forecast\Infrastructure\ForeCast;
use Base\ForeCasts\Forecast\Infrastructure\OpenWeatherForecast;
use Base\ForeCasts\Forecast\Infrastructure\WeatherBitForeCast;
use Illuminate\Support\ServiceProvider;

class ForeCastServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->hasToBeBoundWeatherbit()) {
            $this->app->bind(
                Weatherbit::class,
                function ($app) {
                    $forecast = new Weatherbit();
                    $forecast->setKey(config('weatherbit-api-wrapper.api_key'));
                    return $forecast;
                }
            );

            $this->app->bind(
                ForeCast::class,
                WeatherBitForeCast::class
            );
        } else {
            $this->app->bind(
                ForeCast::class,
                OpenWeatherForecast::class
            );
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * @return bool
     */
    public function hasToBeBoundWeatherbit(): bool
    {


        return config('forecasts.provider') === 'weatherbit';
    }
}
