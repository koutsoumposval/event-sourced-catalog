<?php
namespace EventSourcedCatalog\Testing\Functional\Domain\Catalog\Model\Product;

use EventSourcedCatalog\Domain\Catalog\Model\Product\ProductId;
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