<?php
declare(strict_types=1);

namespace App\Services\Domain\Data;

use Brick\Math\BigInteger;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class FiltersDTO implements Arrayable
{

    public function __construct(
        private readonly ?BigInteger $priceFrom,
        private readonly ?BigInteger $priceTo,
        private readonly Collection $manufacturers,
        private readonly Collection $colours,
        private readonly Collection $sizes
    )
    {

    }

    public function getPriceFrom(): ?BigInteger
    {
        return $this->priceFrom;
    }

    public function getPriceTo(): ?BigInteger
    {
        return $this->priceTo;
    }

    public function getManufacturers(): Collection
    {
        return $this->manufacturers;
    }

    public function getColours(): Collection
    {
        return $this->colours;
    }

    public function getSizes(): Collection
    {
        return $this->sizes;
    }


    public function toArray()
    {
        return [
            'price_from' => $this->priceFrom->toInt(),
            'price_to' => $this->priceTo->toInt(),
            'manufacturers' => $this->manufacturers->toArray(),
            'colours' => $this->colours->toArray(),
            'sizes' => $this->sizes->toArray(),
        ];
    }
}
