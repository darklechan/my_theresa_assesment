<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\Resource;

use MyTheresa\Src\Shared\Common\Domain\Resource\PaginationResponseTraitResource;

class GetProductListPageResponseResource
{
    use PaginationResponseTraitResource;

    /** @var GetProductListDataResponseResource[] */
    public array $items = [];
}
