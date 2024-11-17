<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use MyTheresa\Src\Price\Domain\Entity\Price;
use MyTheresa\Src\Price\Domain\ValueObject\PriceData;
use MyTheresa\Src\Product\Domain\Entity\Product;
use MyTheresa\Src\Product\Domain\Interface\ProductRepositoryInterface;
use MyTheresa\Src\Product\Domain\ValueObject\GetProductListSearchParams;
use MyTheresa\Src\Product\Domain\ValueObject\ProductData;
use MyTheresa\Src\Product\Domain\ValueObject\ProductListPage;
use MyTheresa\Src\Shared\Common\Domain\ValueObject\PaginationResponse;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function save(Product $product): Product
    {
        $product->save();

        return $product;
    }

    public function searchByParams(GetProductListSearchParams $searchParams): ProductListPage
    {
        $query = $this->searchQuery();
        $this->applySearchByParamsFilter($query, $searchParams);

        $paginator = $this->paginateSearchByParamsQuery($query, $searchParams);

        $items = array_map(static function (Product $product) {
            $price = PriceData::create(
                $product->originalPrice,
                $product->finalPrice,
                $product->currency,
                $product->discountPercentage,
            );

            return ProductData::create(
                $product->sku,
                $product->name,
                $product->category_id,
                $price
            );
        }, $paginator->items());

        return new ProductListPage(
            $items,
            new PaginationResponse(
                $paginator->currentPage(),
                $paginator->total(),
                $paginator->perPage(),
                $paginator->lastPage()
            )
        );
    }

    private function searchQuery(): Builder
    {
        return Product::query()
            ->select(
                [
                    'product.sku',
                    'product.name',
                    'product.category_id',
                    'p.original_price as originalPrice',
                    'p.final_price as finalPrice',
                    'p.currency as currency',
                    'p.discount_percentage as discountPercentage',
                ]
            )
            ->with('prices')
            ->from('product')
            ->leftJoin('price as p', 'product.product_id', '=', 'p.product_id');
    }

    private function applySearchByParamsFilter(
        Builder $query,
        GetProductListSearchParams $searchParams
    ): self {
        $category = $searchParams->category()?->getValue();

        if ($category) {
            $query->where('product.category_id', $category);
        }

        return $this;
    }

    private function paginateSearchByParamsQuery(
        Builder $query,
        GetProductListSearchParams $searchParams
    ): LengthAwarePaginator {
        return $query->paginate(
            $searchParams->paginationRequest()?->itemsPerPage(),
            ['*'],
            'page',
            $searchParams->paginationRequest()?->page()
        );
    }
}
