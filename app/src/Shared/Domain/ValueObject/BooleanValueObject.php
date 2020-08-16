<?php

declare(strict_types=1);

namespace Base\Shared\Domain\ValueObject;

abstract class BooleanValueObject
{
    protected bool $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function __toString(): bool
    {
        return $this->value();
    }
}
