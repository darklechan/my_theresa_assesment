<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MyTheresa\Src\Price\Domain\Interface\PriceRepositoryInterface;
use MyTheresa\Src\Price\Infrastructure\Repository\EloquentPriceRepository;
use MyTheresa\Src\Product\Domain\Interface\ProductRepositoryInterface;
use MyTheresa\Src\Product\Infrastructure\Repository\EloquentProductRepository;

class ApiProviders extends ServiceProvider
{
    public array $bindings = [
        ProductRepositoryInterface::class => EloquentProductRepository::class,
        PriceRepositoryInterface::class => EloquentPriceRepository::class,
    ];
}
