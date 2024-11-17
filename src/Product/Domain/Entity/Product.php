<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use MyTheresa\Src\Category\Domain\ValueObject\CategoryId;
use MyTheresa\Src\Price\Domain\Entity\Price;
use MyTheresa\Src\Product\Domain\ValueObject\Name;
use MyTheresa\Src\Product\Domain\ValueObject\ProductId;
use MyTheresa\Src\Product\Domain\ValueObject\Sku;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'product_id';

    // region Relations

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class, 'product_id', 'product_id');
    }

    public function currentPrice(): HasOne
    {
        return $this->hasOne(Price::class)
            ->latestOfMany();
    }

    public function currentPriceObj(): ?Price
    {
        return $this->getRelationValue('currentPrice');
    }

    /**
     * @return Price[]
     */
    public function pricesList(): array
    {
        return $this->getRelationValue('prices')->all();
    }

    public function latestPriceObj(): ?Price
    {
        $collection = $this->getRelationValue('prices');

        return $collection->last();
    }
    // endregion Relations

    public function id(): ProductId
    {
        return new ProductId($this->getAttributeValue('product_id'));
    }

    public function setId(ProductId $productId): self
    {
        return $this->setAttribute('product_id', $productId->value());
    }

    public function sku(): Sku
    {
        return new Sku($this->getAttributeValue('sku'));
    }

    public function setSku(Sku $sku): self
    {
        return $this->setAttribute('sku', $sku->value());
    }

    public function name(): Name
    {
        return new Name($this->getAttributeValue('name'));
    }

    public function setName(Name $name): self
    {
        return $this->setAttribute('name', $name->value());
    }

    public function categoryId(): CategoryId
    {
        return new CategoryId($this->getAttributeValue('category_id'));
    }

    public function setCategoryId(CategoryId $categoryId): self
    {
        return $this->setAttribute('category_id', $categoryId->value());
    }
}
