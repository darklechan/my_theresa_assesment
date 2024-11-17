<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\ValueObject;

use MyTheresa\Src\Category\Domain\ValueObject\CategoryIdEnum;
use MyTheresa\Src\Shared\Common\Domain\ValueObject\PaginationRequest;

class GetProductListSearchParams
{
    public function __construct(
        private ?PaginationRequest $paginationRequest = null,
        private ?CategoryIdEnum $category = null,
    ) {
    }

    public function paginationRequest(): ?PaginationRequest
    {
        return $this->paginationRequest;
    }

    public function category(): ?CategoryIdEnum
    {
        return $this->category;
    }
}
