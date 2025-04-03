<?php
declare(strict_types=1);

namespace Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

final class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    const URL = '/api/products';

    /**
     * A basic feature test example.
     */
    public function testIndexWithoutFilters(): void
    {
        Product::factory()->count(25)
            ->create();

        $response = $this->get(self::URL)
            ->assertOk();

        $response->assertJsonCount(25, 'data.products.data');
        $response->assertJsonStructure([
            'data' => [
                'available_filters' => [
                    'price_from',
                    'price_to',
                    'manufacturers',
                    'colours',
                    'sizes',
                ],
                'products' => [
                    'data' => [[
                        'id',
                        'title',
                        'description',
                        'price',
                        'manufacturer',
                        'colour',
                        'size'
                    ]],
                ]
            ]
        ]);
    }


    public function testWithMinPriceFilter(): void
    {
        Product::factory()->count(25)
            ->create();

        Product::factory()->price1000()->create();

        $response = $this->get(
            $this->prepareQueryParams(
                url: self::URL,
                priceFrom: 1000
            ))
            ->assertOk();

        $response->assertJsonPath('data.available_filters.price_from', 1000);
    }


    public function testInvalidValidation():void
    {
        $this->expectException(ValidationException::class);
        $response = $this->get(self::URL."?filters[colours]=1000");
        $response->assertJsonValidationErrorFor('filters.colours.0');
    }


    private function prepareQueryParams(
        string $url,
        ?int   $priceFrom = null,
        ?int   $priceTo = null,
        ?array $manufacturers = null,
        ?array $colours = null,
        ?array $sizes = null,
    ): string
    {
        return $url . '?' . Arr::query(['filters' => [
                'price_from' => $priceFrom,
                'price_to' => $priceTo,
                'manufacturers' => $manufacturers,
                'colours' => $colours,
                'sizes' => $sizes,
            ]]);
    }

}
