<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Services\Domain\Data\FiltersDTO;
use App\Services\Domain\Data\ProductFiltersDTO;
use App\Services\Domain\Services\ProductFilteredService;
use Brick\Math\BigInteger;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class ProductFilteredRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'filters' => ['nullable', 'array'],
            'filters.price_from' => ['nullable', 'integer'],
            'filters.price_to' => ['nullable', 'integer'],
            'filters.manufacturers' => ['nullable', 'array'],
            'filters.manufacturers.*' => ['string'],
            'filters.colours' => ['nullable', 'array'],
            'filters.colours.*' => ['string'],
            'filters.sizes' => ['nullable', 'array'],
            'filters.sizes.*' => ['string'],
        ];
    }


    public function execute(): ProductFiltersDTO
    {
        return app(ProductFilteredService::class)->handle(filters: $this->makeFiltersDTO());
    }

    private function makeFiltersDTO(): FiltersDTO
    {
        $filters = $this->get('filters');

        return new FiltersDTO(
            priceFrom: Arr::has($filters, 'price_from') ? BigInteger::of(Arr::get($filters, 'price_from')) : null,
            priceTo: Arr::has($filters, 'price_to') ? BigInteger::of(Arr::get($filters, 'price_to')) : null,
            manufacturers: collect(Arr::get($filters, 'manufacturers', [])),
            colours: collect(Arr::get($filters, 'colours', [])),
            sizes: collect(Arr::get($filters, 'sizes', [])),
        );
    }


}
