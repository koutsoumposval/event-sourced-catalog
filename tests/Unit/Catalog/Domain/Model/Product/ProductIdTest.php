<?php
namespace EventSourcedCatalog\Testing\Unit\Catalog\Domain\Model\Product;

use EventSourcedCatalog\Catalog\Domain\Model\Product\ProductId;
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
}
