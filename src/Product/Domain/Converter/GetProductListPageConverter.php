<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\Converter;

use MyTheresa\Src\Product\Domain\Resource\GetProductListPageResponseResource;
use MyTheresa\Src\Product\Domain\ValueObject\ProductData;
use MyTheresa\Src\Product\Domain\ValueObject\ProductListPage;

class GetProductListPageConverter
{
    public function __construct(
        private GetProductListDataConverter $getProductListDataConverter
    ) {
    }

    public function toResource(ProductListPage $productListPage): GetProductListPageResponseResource
    {
        $response = new GetProductListPageResponseResource();

        $response->items = array_map(function (ProductData $productData) {
            return $this->getProductListDataConverter->toResource($productData);
        }, $productListPage->productDataList());

        $response->page = $productListPage->paginationResponse()->page();
        $response->itemsPerPage = $productListPage->paginationResponse()->itemsPerPage();
        $response->totalItems = $productListPage->paginationResponse()->totalItems();
        $response->totalPages = $productListPage->paginationResponse()->totalPages();

        return $response;
    }
}
