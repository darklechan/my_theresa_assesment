<?php

declare(strict_types=1);

namespace MyTheresa\Src\Price\Infrastructure\Repository;

use MyTheresa\Src\Price\Domain\Entity\Price;
use MyTheresa\Src\Price\Domain\Interface\PriceRepositoryInterface;

class EloquentPriceRepository implements PriceRepositoryInterface
{
    public function save(Price $price): Price
    {
        $price->save();

        return $price;
    }
}
