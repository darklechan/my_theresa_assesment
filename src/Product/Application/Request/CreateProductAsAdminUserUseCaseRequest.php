<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Application\Request;

final class CreateProductAsAdminUserUseCaseRequest
{
    private function __construct(
        private string $sku,
        private string $name,
        private int $categoryId,
        private int $price,
        private ?string $discountPercentage,
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

    public function categoryId(): int
    {
        return $this->categoryId;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function discountPercentage(): ?string
    {
        return $this->discountPercentage;
    }

    public static function create(
        string $sku,
        string $name,
        int $categoryId,
        int $price,
        ?string $discountPercentage
    ): self {
        return new self($sku, $name, $categoryId, $price, $discountPercentage);
    }
}
