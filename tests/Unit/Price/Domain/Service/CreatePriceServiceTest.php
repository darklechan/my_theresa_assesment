<?php

declare(strict_types=1);

namespace Tests\Unit\Price\Domain\Service;

use MyTheresa\Src\Price\Domain\Entity\Price;
use MyTheresa\Src\Price\Domain\Request\CreatePriceServiceRequest;
use MyTheresa\Src\Price\Domain\Service\CreatePriceService;
use MyTheresa\Src\Price\Domain\ValueObject\DiscountPercentage;
use MyTheresa\Src\Price\Domain\ValueObject\FinalPrice;
use MyTheresa\Src\Price\Domain\ValueObject\OriginalPrice;
use MyTheresa\Src\Price\Domain\ValueObject\PriceCurrency;
use MyTheresa\Src\Price\Infrastructure\Repository\EloquentPriceRepository;
use MyTheresa\Src\Product\Domain\ValueObject\ProductId;
use MyTheresa\Src\Shared\Common\Domain\ValueObject\MoneyCurrencyEnum;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CreatePriceServiceTest extends TestCase
{
    private CreatePriceService $sut;
    private MockObject $priceRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->priceRepository = $this->createMock(EloquentPriceRepository::class);
        $this->sut = new CreatePriceService(
            $this->priceRepository,
        );
    }

    public function test_when_discount_is_null_final_price_should_be_equal_to_original_price(): void
    {
        $serviceRequest = CreatePriceServiceRequest::create(
            new ProductId(1),
            new OriginalPrice(1000),
            new PriceCurrency(MoneyCurrencyEnum::eur()),
            null
        );

        $price = (new Price())
            ->setProductId($serviceRequest->productId())
            ->setOriginalPrice(new OriginalPrice($serviceRequest->original()->value() * 100))
            ->setFinalPrice(new FinalPrice($serviceRequest->original()->value() * 100))
            ->setDiscountPercentage(null);

        $this->priceRepository
            ->expects($this->once())
            ->method('save')
            ->with($price);

        $this->sut->execute($serviceRequest);
    }

    public function test_has_discount_applied(): void
    {
        $serviceRequest = CreatePriceServiceRequest::create(
            new ProductId(1),
            new OriginalPrice(1000),
            new PriceCurrency(MoneyCurrencyEnum::eur()),
            new DiscountPercentage("10")
        );

        $price = (new Price())
            ->setProductId($serviceRequest->productId())
            ->setOriginalPrice(new OriginalPrice($serviceRequest->original()->value() * 100))
            ->setFinalPrice(new FinalPrice(1000000))
            ->setDiscountPercentage(new DiscountPercentage($serviceRequest->discountPercentage()->value()));

        $this->priceRepository
            ->expects($this->once())
            ->method('save')
            ->with($price);

        $this->sut->execute($serviceRequest);
    }
}
