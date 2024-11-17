<?php

declare(strict_types=1);

namespace MyTheresa\Src\Price\Domain\Service;

use MyTheresa\Src\Price\Domain\Entity\Price;
use MyTheresa\Src\Price\Domain\Request\CreatePriceServiceRequest;
use MyTheresa\Src\Price\Domain\ValueObject\DiscountPercentage;
use MyTheresa\Src\Price\Domain\ValueObject\FinalPrice;
use MyTheresa\Src\Price\Domain\ValueObject\OriginalPrice;
use MyTheresa\Src\Price\Infrastructure\Repository\EloquentPriceRepository;

class CreatePriceService
{
    public function __construct(
        private EloquentPriceRepository $priceRepository
    ) {
    }

    public function execute(CreatePriceServiceRequest $serviceRequest): Price
    {
        $price = (new Price())
            ->setProductId($serviceRequest->productId())
            ->setOriginalPrice(new OriginalPrice($serviceRequest->original()->value() * 100));

        if ($serviceRequest->discountPercentage() === null) {
            $price->setFinalPrice(new FinalPrice($serviceRequest->original()->value() * 100));
            $price->setDiscountPercentage(null);
        }

        if ($serviceRequest->discountPercentage() !== null) {
            $finalPrice = $this->calculateFinalPrice($serviceRequest, $price);

            $price->setFinalPrice($finalPrice);
            $price->setDiscountPercentage($serviceRequest->discountPercentage());
        }

        return $this->priceRepository->save($price);
    }

    private function calculateFinalPrice(
        CreatePriceServiceRequest $serviceRequest,
        Price $price,
    ): FinalPrice {
        $originalPrice = $price->originalPrice();
        $discount = $serviceRequest->discountPercentage();

        $result = ($originalPrice->value() * $discount->value()) / 100;

        return new FinalPrice($result * 100);
    }
}
