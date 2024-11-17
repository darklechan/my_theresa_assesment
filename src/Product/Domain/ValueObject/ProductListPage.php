<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\ValueObject;

use MyTheresa\Src\Shared\Common\Domain\ValueObject\PaginationResponse;

class ProductListPage
{
    public function __construct(
        private array $productDataList,
        private PaginationResponse $paginationResponse
    ) {
    }

    /**
     * @return ProductData[]
     */
    public function productDataList(): array
    {
        return $this->productDataList;
    }

    public function paginationResponse(): PaginationResponse
    {
        return $this->paginationResponse;
    }
}
