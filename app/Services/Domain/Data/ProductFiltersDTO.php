<?php
declare(strict_types=1);

namespace App\Services\Domain\Data;

use Brick\Math\BigInteger;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class ProductFiltersDTO
{

    public function __construct(
        public readonly Collection $products,
        public readonly FiltersDTO $filtersDTO
    )
    {

    }
}
