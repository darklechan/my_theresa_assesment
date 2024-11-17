<?php

namespace MyTheresa\Src\Shared\Common\Domain\Resource;

trait PaginationResponseTraitResource
{
    public int $page;
    public int $itemsPerPage;
    public int $totalItems;
    public int $totalPages;
}
