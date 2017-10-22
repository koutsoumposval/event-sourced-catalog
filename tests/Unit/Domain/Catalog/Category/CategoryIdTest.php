<?php
namespace EventSourcedCatalog\Testing\Unit\Domain\Catalog\Category;

use EventSourcedCatalog\Domain\Catalog\Category\CategoryId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CategoryIdTest extends TestCase
{
    /**
     * @test
     */
    public function it_initializes_uuid(): void
    {
        $categoryId = CategoryId::new();
        $this->assertTrue(Uuid::isValid((string)$categoryId));
    }
}