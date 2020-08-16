<?php

namespace Base\ForeCasts\Forecast\Infrastructure;

use DateTime;

class WeatherbitForeCastResponse implements ForeCastResponse
{
    private int $temperature;
    private string $humidity;
    private string $precipitation;
    private string $wind;
    private string $cityName;
    private DateTime $lastUpdate;

    public function __construct(
        string $cityName,
        int $temperature,
        string $humidity,
        string $precipitation,
        string $wind,
        DateTime $lastUpdate
    )
    {
        $this->temperature   = $temperature;
        $this->humidity      = $humidity;
        $this->precipitation = $precipitation;
        $this->wind          = $wind;
        $this->cityName      = $cityName;
        $this->lastUpdate    = $lastUpdate;
    }

    public function temperature(): int
    {
        return round($this->temperature);
    }

    public function humidity(): string
    {
        return $this->humidity;
    }

    public function precipitation(): string
    {
        return $this->precipitation;
    }

    public function wind(): string
    {
        return $this->wind;
    }

    public function cityName(): string
    {
        return $this->cityName;
    }

    public function lastUpdate(): DateTime
    {
        return $this->lastUpdate;
    }

    public function toPrimitives(): array
    {
        return [
            'cityName'      => $this->cityName(),
            'temperature'   => $this->temperature(),
            'humidity'      => $this->humidity(),
            'precipitation' => $this->precipitation(),
            'wind'          => $this->wind(),
            'lastUpdate'    => $this->lastUpdate()->format('Y-m-d H:i:s')
        ];
    }

}
