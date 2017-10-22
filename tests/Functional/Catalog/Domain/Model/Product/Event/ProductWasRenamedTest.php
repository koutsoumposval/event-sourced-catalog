<?php
namespace EventSourcedCatalog\Testing\Functional\Catalog\Domain\Model\Product\Event;

use EventSourcedCatalog\Catalog\Domain\Model\Product\Event\ProductWasRenamed;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Product;
use EventSourcedCatalog\Catalog\Domain\Model\Product\ValueObject\Name;
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