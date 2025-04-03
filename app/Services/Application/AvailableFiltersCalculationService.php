<?php
declare(strict_types=1);

namespace App\Services\Application;


use App\Services\Domain\Data\FiltersDTO;
use Brick\Math\BigInteger;
use Illuminate\Support\Collection;

class AvailableFiltersCalculationService
{

    public function handle(Collection $filteredProducts): FiltersDTO
    {
        $availableManufacturers = $filteredProducts->groupBy('manufacturer')->keys();

        $availableColours = $filteredProducts->groupBy('colour')->keys();

        $availableSizes = $filteredProducts->groupBy('size')->keys();

        return new FiltersDTO(
            priceFrom: BigInteger::of($filteredProducts->min('price')),
            priceTo: BigInteger::of($filteredProducts->max('price')),
            manufacturers: $availableManufacturers,
            colours: $availableColours,
            sizes: $availableSizes
        );
    }
}
