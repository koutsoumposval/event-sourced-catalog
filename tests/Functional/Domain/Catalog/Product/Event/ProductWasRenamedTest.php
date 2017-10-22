<?php
namespace EventSourcedCatalog\Testing\Functional\Domain\Catalog\Product\Event;

use EventSourcedCatalog\Domain\Catalog\Product\Event\ProductWasRenamed;
use EventSourcedCatalog\Domain\Catalog\Product\Product;
use EventSourcedCatalog\Domain\Catalog\Product\ValueObject\Name;
use EventSourcedCatalog\Testing\Scenarios\Scenario;

class ProductWasRenamedTest extends Scenario
{
    /**
     * @test
     */
    public function product_was_renamed_scenario(): void
    {
        $name = new Name('Product name');
        $product = Product::create($name);
        $newName = new Name('New product name');
        $product->rename($newName);
        $events = $this->popRecordedEvents($product);

        $this->assertCount(2, $events);
        $this->assertInstanceOf(ProductWasRenamed::class, $events[1]);
    }
}