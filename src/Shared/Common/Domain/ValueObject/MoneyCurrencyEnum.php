<?php

declare(strict_types=1);

namespace MyTheresa\Src\Shared\Common\Domain\ValueObject;

use MyCLabs\Enum\Enum;

class MoneyCurrencyEnum extends Enum
{
    public const EUR = 'EUR';
    public const USD = 'USD';

    public const LIST = [
        self::EUR,
        self::USD,
    ];

    public static function eur(): self
    {
        return new self(self::EUR);
    }

    public static function usd(): self
    {
        return new self(self::USD);
    }
}
