<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\Resource;

use MyTheresa\Src\Price\Domain\Resource\GetPriceDataResponseResource;

class GetProductListDataResponseResource
{
    public string $sku;
    public string $name;
    public string $category;
    public ?GetPriceDataResponseResource $price;
}
