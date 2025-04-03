<?php
declare(strict_types=1);

namespace App\Services\Domain\Repositories;

interface ProductRepositoryInterface
{
    public function getFiltered(
        ?int $priceFrom,
        ?int $priceTo,
        ?array $manufacturers,
        ?array $colours,
        ?array $sizes
    );
}
