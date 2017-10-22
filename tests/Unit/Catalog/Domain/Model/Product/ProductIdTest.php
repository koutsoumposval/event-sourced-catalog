<?php
namespace EventSourcedCatalog\Testing\Unit\Catalog\Domain\Model\Product;

use EventSourcedCatalog\Catalog\Domain\Model\Product\ProductId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ProductIdTest extends TestCase
{
    /**
     * @test
     */
    public function it_initializes_uuid(): void
    {
        $categoryId = ProductId::new();
        $this->assertTrue(Uuid::isValid((string)$categoryId));
    }

    /**
     * @test
     */
    public function it_initializes_from_string(): void
    {
        $uuidString = (string)Uuid::uuid1();
        $rootId = ProductId::fromString($uuidString);
        $this->assertEquals((string)$rootId, $uuidString);
    }

    /**
     * @test
     * @dataProvider invalidStrings
     * @param string $input
     */
    public function it_throws_exceptions_when_trying_to_initialize_with_invalid_string(string $input): void
    {
        $this->expectException(InvalidArgumentException::class);
        ProductId::fromString($input);
    }

    /**
     * @return array
     */
    public function invalidStrings(): array
    {
        return [
            'empty string' => [''],
            'additional character' => ['821618f6-b4d3-11e7-8113-24a074f12168a'],
            'underscores' => ['821618f6_b4d3_11e7_8113_24a074f12168']
        ];
    }
}
