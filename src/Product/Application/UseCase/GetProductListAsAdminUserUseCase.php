<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Application\UseCase;

use MyTheresa\Src\Category\Domain\ValueObject\CategoryIdEnum;
use MyTheresa\Src\Product\Application\Request\GetProductListAsAdminUserUseCaseRequest;
use MyTheresa\Src\Product\Domain\Converter\GetProductListPageConverter;
use MyTheresa\Src\Product\Domain\Interface\ProductRepositoryInterface;
use MyTheresa\Src\Product\Domain\Resource\GetProductListPageResponseResource;
use MyTheresa\Src\Product\Domain\ValueObject\GetProductListSearchParams;
use MyTheresa\Src\Shared\Common\Domain\ValueObject\PaginationRequest;

class GetProductListAsAdminUserUseCase
{
    public function __construct(
        private GetProductListPageConverter $getProductListPageConverter,
        private ProductRepositoryInterface $productRepository,
    ) {
    }

    public function execute(
        GetProductListAsAdminUserUseCaseRequest $useCaseRequest
    ): GetProductListPageResponseResource {
        return $this->getProductListPaginated($useCaseRequest);
    }

    private function getProductListPaginated(
        GetProductListAsAdminUserUseCaseRequest $useCaseRequest
    ): GetProductListPageResponseResource {
        $filters = $this->createFilter($useCaseRequest);
        $paginatedResponse = $this->productRepository->searchByParams($filters);

        return $this->getProductListPageConverter->toResource($paginatedResponse);
    }

    private function createFilter(
        GetProductListAsAdminUserUseCaseRequest $useCaseRequest
    ): GetProductListSearchParams {
        $paginationRequest = $useCaseRequest->page() !== null && $useCaseRequest->itemsPerPage() !== null
            ? new PaginationRequest($useCaseRequest->page(), $useCaseRequest->itemsPerPage())
            : null;

        $category = $useCaseRequest->category() !== null
            ? new CategoryIdEnum($useCaseRequest->category())
            : null;

        return new GetProductListSearchParams(
            $paginationRequest,
            $category
        );
    }
}
