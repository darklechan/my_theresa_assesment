<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\Interface;

use MyTheresa\Src\Product\Domain\Entity\Product;
use MyTheresa\Src\Product\Domain\ValueObject\GetProductListSearchParams;
use MyTheresa\Src\Product\Domain\ValueObject\ProductListPage;

interface ProductRepositoryInterface
{
    public function save(Product $product): Product;
    public function searchByParams(GetProductListSearchParams $searchParams): ProductListPage;
}
