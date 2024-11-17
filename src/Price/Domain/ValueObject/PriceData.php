<?php

declare(strict_types=1);

namespace MyTheresa\Src\Price\Domain\ValueObject;

class PriceData
{
    private function __construct(
        private int $originalPrice,
        private int $finalPrice,
        private string $currency,
        private ?string $discountPercentage,
    ) {
    }

    public function originalPrice(): int
    {
        return $this->originalPrice;
    }

    public function finalPrice(): int
    {
        return $this->finalPrice;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function discountPercentage(): ?string
    {
        return $this->discountPercentage;
    }

    public static function create(
        int $originalPrice,
        int $finalPrice,
        string $currency,
        ?string $discountPercentage
    ): self {
        return new self($originalPrice, $finalPrice, $currency, $discountPercentage);
    }
}
