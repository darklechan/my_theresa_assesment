<?php

declare(strict_types=1);

namespace Tests\Unit\Product\Application\UseCase;

use MyTheresa\Src\Category\Domain\ValueObject\CategoryId;
use MyTheresa\Src\Category\Domain\ValueObject\CategoryIdEnum;
use MyTheresa\Src\Price\Domain\ValueObject\DiscountPercentage;
use MyTheresa\Src\Price\Domain\ValueObject\OriginalPrice;
use MyTheresa\Src\Product\Application\Request\CreateProductAsAdminUserUseCaseRequest;
use MyTheresa\Src\Product\Application\UseCase\CreateProductAsAdminUserUseCase;
use MyTheresa\Src\Product\Domain\Request\CreateProductServiceRequest;
use MyTheresa\Src\Product\Domain\Service\CreateProductService;
use MyTheresa\Src\Product\Domain\ValueObject\Name;
use MyTheresa\Src\Product\Domain\ValueObject\Sku;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CreateProductAsAdminUserUseCaseTest extends TestCase
{
    private CreateProductAsAdminUserUseCase $sut;
    private MockObject $createProductService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createProductService = $this->createMock(CreateProductService::class);
        $this->sut = new CreateProductAsAdminUserUseCase(
            $this->createProductService,
        );
    }

    public function test_create_product(): void
    {
        $useCaseRequest = CreateProductAsAdminUserUseCaseRequest::create(
            'sku',
            'name',
            CategoryIdEnum::sandals()->getValue(),
            1000,
            null
        );

        $this->createProductService
            ->expects($this->once())
            ->method('execute')
            ->with(
                CreateProductServiceRequest::create(
                    new Sku($useCaseRequest->sku()),
                    new Name($useCaseRequest->name()),
                    new CategoryId($useCaseRequest->categoryId()),
                    new OriginalPrice($useCaseRequest->price()),
                    new DiscountPercentage($useCaseRequest->discountPercentage())
                )
            );

        $this->sut->execute($useCaseRequest);
    }
}
