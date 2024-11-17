<?php

declare(strict_types=1);

namespace MyTheresa\Src\Price\Domain\Resource;

class GetPriceDataResponseResource
{
    public int $original;
    public int $final;
    public ?string $discountPercentage;
    public string $currency;
}
