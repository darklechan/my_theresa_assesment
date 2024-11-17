<?php

declare(strict_types=1);

namespace MyTheresa\Src\Shared\Common\Domain\ValueObject;

class AmountMinUnitValueObject
{
    public function __construct(
        public int $value,
        public string $moneyCurrency = MoneyCurrencyEnum::EUR,
    ) {
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->format();
    }

    public function value(): int
    {
        return $this->value;
    }

    private function format(): string
    {
        return number_format($this->value() / 100, 2, ',', '.');
    }
}
