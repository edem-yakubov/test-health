<?php
declare(strict_types=1);

namespace App\Services\Infrastructure\Domain\Product\Repository;

use App\Models\Product;
use App\Services\Domain\Repositories\ProductRepositoryInterface;

class EloquentProductRepository implements ProductRepositoryInterface
{

    public function getFiltered(
        ?int $priceFrom,
        ?int $priceTo,
        ?array $manufacturers,
        ?array $colours,
        ?array $sizes
    )
    {
        return Product::query()
            ->when($priceFrom, fn($query) => $query->where('price', '>=', $priceFrom))
            ->when($priceTo, fn($query) => $query->where('price', '<=', $priceTo))
            ->when($manufacturers, fn($query) => $query->whereIn('manufacturer', $manufacturers))
            ->when($colours, fn($query) => $query->whereIn('colour', $colours))
            ->when($sizes, fn($query) => $query->whereIn('size', $sizes))
            ->get();

    }
}
