<?php

declare(strict_types=1);

namespace MyTheresa\Src\Product\Domain\Service;

use MyTheresa\Src\Category\Domain\ValueObject\CategoryIdEnum;
use MyTheresa\Src\Price\Domain\Request\CreatePriceServiceRequest;
use MyTheresa\Src\Price\Domain\Service\CreatePriceService;
use MyTheresa\Src\Price\Domain\ValueObject\DiscountPercentage;
use MyTheresa\Src\Price\Domain\ValueObject\PriceCurrency;
use MyTheresa\Src\Product\Domain\Entity\Product;
use MyTheresa\Src\Product\Domain\Request\CreateProductServiceRequest;
use MyTheresa\Src\Product\Infrastructure\Repository\EloquentProductRepository;
use MyTheresa\Src\Shared\Common\Domain\ValueObject\MoneyCurrencyEnum;

class CreateProductService
{
    private const SKU_000003 = '000003';
    private const THIRTY_PERCENTAGE_DISCOUNT = '30';
    private const FIFTY_PERCENTAGE_DISCOUNT = '15';

    public function __construct(
        private EloquentProductRepository $productRepository,
        private CreatePriceService $createPriceService,
    ) {
    }

    public function execute(
        CreateProductServiceRequest $serviceRequest,
    ): Product {
        $product = (new Product())
            ->setSku($serviceRequest->sku())
            ->setName($serviceRequest->name())
            ->setCategoryId($serviceRequest->categoryId());

        $createdProduct = $this->productRepository->save($product);

        $discount = $this->calculateDiscount($serviceRequest);

        $this->createPriceService->execute(CreatePriceServiceRequest::create(
            $createdProduct->id(),
            $serviceRequest->originalPrice(),
            new PriceCurrency(MoneyCurrencyEnum::eur()),
            $discount
        ));

        return $createdProduct;
    }

    private function calculateDiscount(CreateProductServiceRequest $serviceRequest): ?DiscountPercentage
    {
        if ($serviceRequest->categoryId()->value === CategoryIdEnum::boots()->getValue()) {
            return new DiscountPercentage(self::THIRTY_PERCENTAGE_DISCOUNT);
        }

        if ($serviceRequest->sku()->value() === self::SKU_000003) {
            return new DiscountPercentage(self::FIFTY_PERCENTAGE_DISCOUNT);
        }

        return $serviceRequest->discountPercentage();
    }
}
