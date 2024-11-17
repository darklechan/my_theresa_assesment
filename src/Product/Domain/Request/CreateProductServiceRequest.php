<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\Request;

use MyTheresa\Src\Category\Domain\ValueObject\CategoryId;
use MyTheresa\Src\Price\Domain\ValueObject\DiscountPercentage;
use MyTheresa\Src\Price\Domain\ValueObject\FinalPrice;
use MyTheresa\Src\Price\Domain\ValueObject\OriginalPrice;
use MyTheresa\Src\Product\Domain\ValueObject\Name;
use MyTheresa\Src\Product\Domain\ValueObject\Sku;

final class CreateProductServiceRequest
{
    private function __construct(
        private Sku $sku,
        private Name $name,
        private CategoryId $categoryId,
        private OriginalPrice $originalPrice,
        private ?DiscountPercentage $discountPercentage,
    ) {
    }

    public function sku(): Sku
    {
        return $this->sku;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function categoryId(): CategoryId
    {
        return $this->categoryId;
    }

    public function originalPrice(): OriginalPrice
    {
        return $this->originalPrice;
    }

    public function discountPercentage(): ?DiscountPercentage
    {
        return $this->discountPercentage;
    }

    public static function create(
        Sku $sku,
        Name $name,
        CategoryId $categoryId,
        OriginalPrice $originalPrice,
        ?DiscountPercentage $discountPercentage
    ): self {
        return new self($sku, $name, $categoryId, $originalPrice, $discountPercentage);
    }
}
