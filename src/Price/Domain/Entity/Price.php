<?php

declare(strict_types=1);

namespace MyTheresa\Src\Price\Domain\Entity;

use Illuminate\Database\Eloquent\Model;
use MyTheresa\Src\Price\Domain\ValueObject\DiscountPercentage;
use MyTheresa\Src\Price\Domain\ValueObject\FinalPrice;
use MyTheresa\Src\Price\Domain\ValueObject\OriginalPrice;
use MyTheresa\Src\Price\Domain\ValueObject\PriceCurrency;
use MyTheresa\Src\Price\Domain\ValueObject\PriceId;
use MyTheresa\Src\Product\Domain\ValueObject\ProductId;

class Price extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'price';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'price_id';

    public function id(): PriceId
    {
        return new PriceId($this->getAttributeValue('price_id'));
    }

    public function setId(PriceId $priceId): self
    {
        return $this->setAttribute('price_id', $priceId->value());
    }

    public function productId(): ProductId
    {
        return new ProductId($this->getAttributeValue('product_id'));
    }

    public function setProductId(ProductId $productId): self
    {
        return $this->setAttribute('product_id', $productId->value());
    }

    public function originalPrice(): OriginalPrice
    {
        return new OriginalPrice($this->getAttributeValue('original_price'));
    }

    public function setOriginalPrice(OriginalPrice $originalPrice): self
    {
        return $this->setAttribute('original_price', $originalPrice->value());
    }

    public function finalPrice(): FinalPrice
    {
        return new FinalPrice($this->getAttributeValue('final_price'));
    }

    public function setFinalPrice(FinalPrice $finalPrice): self
    {
        return $this->setAttribute('final_price', $finalPrice->value());
    }

    public function currency(): PriceCurrency
    {
        return new PriceCurrency($this->getAttributeValue('currency'));
    }

    public function setCurrency(PriceCurrency $currency): self
    {
        return $this->setAttribute('currency', $currency->value());
    }

    public function discountPercentage(): ?DiscountPercentage
    {
        $value = $this->getAttributeValue('discount_percentage');

        return $value !== null ? new DiscountPercentage($value) : null;
    }

    public function setDiscountPercentage(?DiscountPercentage $discountPercentage): self
    {
        return $this->setAttribute('discount_percentage', $discountPercentage?->value());
    }
}
