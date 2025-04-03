<?php

declare(strict_types=1);

namespace App\Services\Domain\Services;


use App\Services\Application\AvailableFiltersCalculationService;
use App\Services\Domain\Data\FiltersDTO;
use App\Services\Domain\Data\ProductFiltersDTO;

class ProductFilteredService
{
    public function __construct(
        private readonly ProductService                     $productService,
        private readonly AvailableFiltersCalculationService $availableFiltersCalculationService
    )
    {}

    public function handle(FiltersDTO $filters): ProductFiltersDTO
    {
        $filteredProducts = $this->productService->handle($filters);

        if($filteredProducts->isEmpty()){
          abort(400, 'Products not found');
        }

        $availableFilters = $this->availableFiltersCalculationService->handle($filteredProducts);

        return new ProductFiltersDTO(
            products: $filteredProducts,
            filtersDTO: $availableFilters
        );
    }
}
