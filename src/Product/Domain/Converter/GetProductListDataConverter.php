<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\Converter;

use MyTheresa\Src\Category\Domain\ValueObject\CategoryNameEnum;
use MyTheresa\Src\Price\Domain\Converter\GetPriceDataConverter;
use MyTheresa\Src\Product\Domain\Resource\GetProductListDataResponseResource;
use MyTheresa\Src\Product\Domain\ValueObject\ProductData;

class GetProductListDataConverter
{
    public function __construct(
        private GetPriceDataConverter $getPriceDataConverter,
    ) {
    }

    public function toResource(ProductData $productData): GetProductListDataResponseResource
    {
        $response = new GetProductListDataResponseResource();

        $response->sku = $productData->sku();
        $response->name = $productData->name();
        $response->category = CategoryNameEnum::getCategoryNameById($productData->category());

        $price = $productData->price();
        $response->price = $price !== null
            ? $this->getPriceDataConverter->toResource($price)
            : null;

        return $response;
    }
}
