<?php

namespace App\Services\Domain\Services;

use App\Services\Domain\Data\FiltersDTO;
use App\Services\Domain\Repositories\ProductRepositoryInterface;
use Brick\Math\Exception\MathException;
use Illuminate\Support\Collection;

class ProductService
{

    public function __construct(private readonly ProductRepositoryInterface $repository)
    {

    }

    /**
     * @throws MathException
     */
    public function handle(FiltersDTO $filters): Collection
    {
        return $this->repository->getFiltered(
            priceFrom: $filters->getPriceFrom()?->toInt(),
            priceTo: $filters->getPriceTo()?->toInt(),
            manufacturers: $filters->getManufacturers()->toArray(),
            colours: $filters->getColours()->toArray(),
            sizes: $filters->getSizes()->toArray()
        );
    }

}
