<?php

declare(strict_types=1);

namespace MyTheresa\Src\Shared\Common\Domain\ValueObject;

class CurrencyValueObject
{
    public function __construct(
        public MoneyCurrencyEnum $currency
    ) {
    }

    public function __toString(): string
    {
        return $this->value()->getValue();
    }

    public function value(): MoneyCurrencyEnum
    {
        return $this->currency;
    }
}
