<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Application\Request;

final class GetProductListAsAdminUserUseCaseRequest
{
    private function __construct(
        private ?int $page = null,
        private ?int $itemsPerPage = null,
        private ?int $category = null,
    ) {
    }

    public function page(): ?int
    {
        return $this->page;
    }

    public function itemsPerPage(): ?int
    {
        return $this->itemsPerPage;
    }

    public function category(): ?int
    {
        return $this->category;
    }

    public static function create(
        ?int $page = null,
        ?int $itemsPerPage = null,
        ?int $category = null
    ): self {
        return new self($page, $itemsPerPage, $category);
    }
}
