<?php

declare(strict_types=1);

namespace MyTheresa\Src\Shared\Common\Domain\ValueObject;

abstract class IntValueObject
{
    public function __construct(
        public int $value
    ) {
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(IntValueObject $other): bool
    {
        return $this->value() === $other->value();
    }
}
