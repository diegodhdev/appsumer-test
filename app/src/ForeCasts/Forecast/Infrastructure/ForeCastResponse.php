<?php

namespace Base\ForeCasts\Forecast\Infrastructure;

use DateTime;

interface ForeCastResponse
{
    public function cityName(): string;

    public function temperature(): int;

    public function humidity(): string;

    public function precipitation(): string;

    public function wind(): string;

    public function toPrimitives(): array;

    public function lastUpdate(): DateTime;
}
