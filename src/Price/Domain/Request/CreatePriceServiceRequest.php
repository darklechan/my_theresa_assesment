<?php

declare(strict_types=1);

namespace MyTheresa\Src\Price\Domain\Request;

use MyTheresa\Src\Price\Domain\ValueObject\DiscountPercentage;
use MyTheresa\Src\Price\Domain\ValueObject\FinalPrice;
use MyTheresa\Src\Price\Domain\ValueObject\OriginalPrice;
use MyTheresa\Src\Price\Domain\ValueObject\PriceCurrency;
use MyTheresa\Src\Product\Domain\ValueObject\ProductId;

final class CreatePriceServiceRequest
{
    private function __construct(
        private ProductId $productId,
        private OriginalPrice $original,
        private PriceCurrency $priceCurrency,
        private ?DiscountPercentage $discountPercentage
    ) {
    }

    public function productId(): ProductId
    {
        return $this->productId;
    }

    public function original(): OriginalPrice
    {
        return $this->original;
    }

    public function priceCurrency(): PriceCurrency
    {
        return $this->priceCurrency;
    }

    public function discountPercentage(): ?DiscountPercentage
    {
        return $this->discountPercentage;
    }

    public static function create(
        ProductId $productId,
        OriginalPrice $original,
        PriceCurrency $priceCurrency,
        ?DiscountPercentage $discountPercentage
    ): self {
        return new self($productId, $original, $priceCurrency, $discountPercentage);
    }
}
