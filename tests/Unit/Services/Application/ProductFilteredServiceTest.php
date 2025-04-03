<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Application;

use App\Services\Application\AvailableFiltersCalculationService;
use App\Services\Domain\Data\FiltersDTO;
use App\Services\Domain\Services\ProductFilteredService;
use App\Services\Domain\Services\ProductService;
use Brick\Math\BigInteger;
use PHPUnit\Framework\TestCase;

final class ProductFilteredServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testServiceCallsOtherServices(): void
    {
        $filtersDTO = new FiltersDTO(
            priceFrom: BigInteger::of(1000),
            priceTo: BigInteger::of(10000),
            manufacturers: collect(),
            colours: collect(),
            sizes: collect()
        );

        $productService = $this->createMock(ProductService::class);
        $productService->expects($this->once())
            ->method('handle')
            ->with($this->identicalTo($filtersDTO))
            ->willReturn(collect([
                [
                    'id' => 1,
                    'title' => 'some title',
                    'price' => 1300,
                    'manufacturer' => 'Adidas',
                    'colour' => 'Red',
                    'size' => 'S'
                ]
            ]));

        $availableFiltersCalculationService = $this->createMock(AvailableFiltersCalculationService::class);

        $availableFiltersCalculationService->expects($this->once())
            ->method('handle');

        $service = new ProductFilteredService(
            productService: $productService,
            availableFiltersCalculationService: $availableFiltersCalculationService,
        );

        $service->handle($filtersDTO);


    }
}
