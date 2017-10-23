<?php
namespace EventSourcedCatalog\Testing\Functional\Catalog\Domain\Model\Product\Event;

use EventSourcedCatalog\Catalog\Domain\Model\Category\CategoryId;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Event\CategoryWasRemoved;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Product;
use EventSourcedCatalog\Catalog\Domain\Model\Product\ValueObject\Name;
use EventSourcedCatalog\Testing\Scenarios\Scenario;

class CategoryWasRemovedTest extends Scenario
{
    /**
     * @test
     */
    public function category_was_removed_scenario(): void
    {
        $name = new Name('Product name');
        $product = Product::create($name);
        $categoryId = CategoryId::new();
        $product->addCategory($categoryId);
        $product->removeCategory($categoryId);
        $events = $this->popRecordedEvents($product);

        $this->assertCount(3, $events);
        $this->assertInstanceOf(CategoryWasRemoved::class, $events[2]);
    }
}
