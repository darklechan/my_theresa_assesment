<?php

declare(strict_types=1);

namespace Tests\Unit\Product\Application\UseCase;

use MyTheresa\Src\Category\Domain\ValueObject\CategoryIdEnum;
use MyTheresa\Src\Category\Domain\ValueObject\CategoryNameEnum;
use MyTheresa\Src\Product\Application\Request\GetProductListAsAdminUserUseCaseRequest;
use MyTheresa\Src\Product\Application\UseCase\GetProductListAsAdminUserUseCase;
use MyTheresa\Src\Product\Domain\Converter\GetProductListPageConverter;
use MyTheresa\Src\Product\Domain\Interface\ProductRepositoryInterface;
use MyTheresa\Src\Product\Domain\Resource\GetProductListDataResponseResource;
use MyTheresa\Src\Product\Domain\Resource\GetProductListPageResponseResource;
use MyTheresa\Src\Product\Domain\ValueObject\GetProductListSearchParams;
use MyTheresa\Src\Product\Domain\ValueObject\ProductData;
use MyTheresa\Src\Product\Domain\ValueObject\ProductListPage;
use MyTheresa\Src\Shared\Common\Domain\ValueObject\PaginationRequest;
use MyTheresa\Src\Shared\Common\Domain\ValueObject\PaginationResponse;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class GetProductListAsAdminUserUseCaseTest extends TestCase
{
    private GetProductListAsAdminUserUseCase $sut;
    private MockObject $getProductListPageConverter;
    private MockObject $productRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->getProductListPageConverter = $this->createMock(GetProductListPageConverter::class);
        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);

        $this->sut = new GetProductListAsAdminUserUseCase(
            $this->getProductListPageConverter,
            $this->productRepository,
        );
    }

    public function test_response_is_obtained_correctly(): void
    {
        $useCaseRequest = GetProductListAsAdminUserUseCaseRequest::create(
            1,
            20,
            CategoryIdEnum::sandals()->getValue()
        );

        $dataResponse = new GetProductListDataResponseResource();
        $dataResponse->sku = "sku";
        $dataResponse->name = "name";
        $dataResponse->category = CategoryNameEnum::sandals()->getValue();
        $dataResponse->price = null;

        $expectedResponse = new GetProductListPageResponseResource();
        $expectedResponse->page = 1;
        $expectedResponse->itemsPerPage = 20;
        $expectedResponse->totalItems = 1;
        $expectedResponse->totalPages = 5;
        $expectedResponse->items = [$dataResponse];

        $paginationRequest = new PaginationRequest(
            $useCaseRequest->page(),
            $useCaseRequest->itemsPerPage(),
        );

        $searchParams = new GetProductListSearchParams(
            $paginationRequest,
            CategoryIdEnum::sandals()
        );

        $data = ProductData::create(
            "sku",
            "name",
            CategoryIdEnum::sandals()->getValue(),
            null
        );

        $paginationResponse = new PaginationResponse(
            1,
            20,
            1,
            5
        );

        $productListPage = new ProductListPage([$data], $paginationResponse);

        $this->productRepository
            ->expects($this->once())
            ->method('searchByParams')
            ->with($searchParams)
            ->willReturn($productListPage);

        $this->getProductListPageConverter
            ->expects($this->once())
            ->method('toResource')
            ->with($productListPage)
            ->willReturn($expectedResponse);

        $actualResponse = $this->sut->execute($useCaseRequest);
        $this->assertEquals($expectedResponse, $actualResponse);
    }
}
