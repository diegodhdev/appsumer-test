<?php

namespace App\Providers;

use Base\ForeCasts\Forecast\Infrastructure\ForeCast;
use Base\ForeCasts\Forecast\Infrastructure\WeatherBitForeCast;
use Base\Shared\Domain\Bus\Command\CommandBus;
use Base\Shared\Infrastructure\Bus\Command\InMemorySymfonyCommandBus;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind(
//            CommandBus::class,
//            InMemorySymfonyCommandBus::class
//        );


        //
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
}
