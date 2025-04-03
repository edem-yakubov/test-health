<?php

namespace App\Http\Resources;

use App\Services\Domain\Data\ProductFiltersDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ProductFiltersDTO
 */
class ProductFilterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'available_filters' => $this->filtersDTO->toArray(),
            'products' => $this->products->paginate(25),
        ];
    }
}
