<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Application\UseCase;

use MyTheresa\Src\Category\Domain\ValueObject\CategoryId;
use MyTheresa\Src\Price\Domain\ValueObject\DiscountPercentage;
use MyTheresa\Src\Price\Domain\ValueObject\OriginalPrice;
use MyTheresa\Src\Product\Application\Request\CreateProductAsAdminUserUseCaseRequest;
use MyTheresa\Src\Product\Domain\Request\CreateProductServiceRequest;
use MyTheresa\Src\Product\Domain\Service\CreateProductService;
use MyTheresa\Src\Product\Domain\ValueObject\Name;
use MyTheresa\Src\Product\Domain\ValueObject\Sku;

class CreateProductAsAdminUserUseCase
{
    public function __construct(
        private CreateProductService $createProductService,
    ) {
    }

    public function execute(CreateProductAsAdminUserUseCaseRequest $useCaseRequest): void
    {
        $this->createProductService->execute(
            CreateProductServiceRequest::create(
                new Sku($useCaseRequest->sku()),
                new Name($useCaseRequest->name()),
                new CategoryId($useCaseRequest->categoryId()),
                new OriginalPrice($useCaseRequest->price()),
                new DiscountPercentage($useCaseRequest->discountPercentage())
            )
        );
    }
}
