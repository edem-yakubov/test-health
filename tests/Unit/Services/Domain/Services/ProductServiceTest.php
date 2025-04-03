<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Domain\Services;

use App\Services\Domain\Data\FiltersDTO;
use App\Services\Domain\Repositories\ProductRepositoryInterface;
use App\Services\Domain\Services\ProductService;
use Brick\Math\BigInteger;
use Brick\Math\Exception\MathException;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

final class ProductServiceTest extends TestCase
{
    /**
     * @throws MathException
     */
    public function testCallsRepository(): void
    {
        $repositoryMock = $this->createMock(ProductRepositoryInterface::class);

        $repositoryMock->expects($this->once())
            ->method('getFiltered')
            ->with(
                100,
                999,
                ['Adidas'],
                ['Red'],
                ['L', 'XL'])

            ->willReturn(collect([]));

        $filtersDTO = new FiltersDTO(
            priceFrom: BigInteger::of(100),
            priceTo: BigInteger::of(999),
            manufacturers: collect(['Adidas']),
            colours: collect(['Red']),
            sizes: collect(['L', 'XL'])
        );

        $service = new ProductService($repositoryMock);
        $result = $service->handle($filtersDTO);

        $this->assertInstanceOf(Collection::class, $result);
    }

}
