<?php

declare(strict_types=1);

namespace MyTheresa\Src\Category\Domain\ValueObject;

use MyCLabs\Enum\Enum;

class CategoryIdEnum extends Enum
{
    private const BOOTS = 1;
    private const SANDALS = 2;
    private const SNEAKERS = 3;

    public const LIST = [
        self::BOOTS,
        self::SANDALS,
        self::SNEAKERS,
    ];

    public static function boots(): self
    {
        return new self(self::BOOTS);
    }

    public static function sandals(): self
    {
        return new self(self::SANDALS);
    }

    public static function sneakers(): self
    {
        return new self(self::SNEAKERS);
    }
}
