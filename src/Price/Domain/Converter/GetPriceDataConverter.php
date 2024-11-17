<?php

declare(strict_types=1);

namespace MyTheresa\Src\Price\Domain\Converter;

use MyTheresa\Src\Price\Domain\Resource\GetPriceDataResponseResource;
use MyTheresa\Src\Price\Domain\ValueObject\PriceData;

class GetPriceDataConverter
{
    private const PERCENTAGE_SYMBOL = '%';

    public function toResource(PriceData $price): GetPriceDataResponseResource
    {
        $response = new GetPriceDataResponseResource();
        $response->original = $price->originalPrice();
        $response->final = $price->finalPrice();
        $response->discountPercentage = $price->discountPercentage() . self::PERCENTAGE_SYMBOL;
        $response->currency = $price->currency();

        return $response;
    }
}
