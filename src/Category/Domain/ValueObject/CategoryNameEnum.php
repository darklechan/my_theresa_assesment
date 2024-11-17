<?php

declare(strict_types=1);

namespace MyTheresa\Src\Category\Domain\ValueObject;

use DomainException;
use MyCLabs\Enum\Enum;

class CategoryNameEnum extends Enum
{
    private const BOOTS = 'boots';
    private const SANDALS = 'sandals';
    private const SNEAKERS = 'sneakers';

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

    public static function getCategoryNameById(int $categoryId): string
    {
        return match ($categoryId) {
            CategoryIdEnum::boots()->getValue() => self::BOOTS,
            CategoryIdEnum::sandals()->getValue() => self::SANDALS,
            CategoryIdEnum::sneakers()->getValue() => self::SNEAKERS,
            default => throw new DomainException('Category id ' . $categoryId . ' not found'),
        };
    }
}
