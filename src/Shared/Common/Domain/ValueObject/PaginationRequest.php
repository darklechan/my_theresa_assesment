<?php

declare(strict_types=1);

namespace MyTheresa\Src\Shared\Common\Domain\ValueObject;

class PaginationRequest
{
    public function __construct(
        private int $page,
        private int $itemsPerPage
    ) {
    }

    public function page(): int
    {
        return $this->page;
    }

    public function itemsPerPage(): int
    {
        return $this->itemsPerPage;
    }
}
