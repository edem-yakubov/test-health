<?php
declare(strict_types=1);

namespace Tests\Unit\Services\Domain\Services;


use App\Services\Application\AvailableFiltersCalculationService;
use PHPUnit\Framework\TestCase;

final class AvailableFiltersCalculationServiceTest extends TestCase
{

    public function testReturnsFilteredDTO():void
    {
        $items = collect([
            [
                'id' => 1,
                'title' => 'Title 1',
                'description' => 'Description 1',
                'price' => 100,
                'manufacturer' => 'Adidas',
                'colour' => 'Red',
                'size' => 'XL'
            ],
            [
                'id' => 2,
                'title' => 'Title 2',
                'description' => 'Description 1',
                'price' => 999,
                'manufacturer' => 'Reebok',
                'colour' => 'Green',
                'size' => 'S'
            ]
        ]);

       $service = new AvailableFiltersCalculationService();
       $result = $service->handle($items);


       $this->assertSame(100, $result->getPriceFrom()->toInt());
       $this->assertSame(999, $result->getPriceTo()->toInt());
       $this->assertSame(['XL', 'S'], $result->getSizes()->toArray());
       $this->assertSame(['Red', 'Green'], $result->getColours()->toArray());
       $this->assertSame(['Adidas', 'Reebok'], $result->getManufacturers()->toArray());

    }
}
