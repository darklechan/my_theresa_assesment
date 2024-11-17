<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\ValueObject;

use MyTheresa\Src\Price\Domain\ValueObject\PriceData;

class ProductData
{
    private function __construct(
        private string $sku,
        private string $name,
        private int $category,
        private ?PriceData $price
    ) {
    }

    public function sku(): string
    {
        return $this->sku;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function category(): int
    {
        return $this->category;
    }

    public function price(): ?PriceData
    {
        return $this->price;
    }

    public static function create(
        string $sku,
        string $name,
        int $category,
        ?PriceData $price
    ): self {
        return new self($sku, $name, $category, $price);
    }
}
