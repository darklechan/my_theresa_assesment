<?php

declare(strict_types=1);

namespace MyTheresa\Src\Price\Domain\Interface;

use MyTheresa\Src\Price\Domain\Entity\Price;

interface PriceRepositoryInterface
{
    public function save(Price $price): Price;
}
