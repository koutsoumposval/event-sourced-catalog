<?php
namespace EventSourcedCatalog\Testing\Functional\Domain\Catalog\Product\Event;

use EventSourcedCatalog\Domain\Catalog\Product\Event\ProductWasCreated;
use EventSourcedCatalog\Domain\Catalog\Product\Product;
use EventSourcedCatalog\Domain\Catalog\Product\ValueObject\Name;
use EventSourcedCatalog\Testing\Scenarios\Scenario;

class ProductWasCreatedTest extends Scenario
{
    /**
     * @test
     */
    public function product_was_created_scenario(): void
    {
        $name = new Name('Product name');
        $product = Product::create($name);
        $events = $this->popRecordedEvents($product);

        $this->assertCount(1, $events);
        $this->assertInstanceOf(ProductWasCreated::class, $events[0]);
    }
}