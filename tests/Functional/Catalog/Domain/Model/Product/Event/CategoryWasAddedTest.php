<?php
namespace EventSourcedCatalog\Testing\Functional\Catalog\Domain\Model\Product\Event;

use EventSourcedCatalog\Catalog\Domain\Model\Category\CategoryId;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Event\CategoryWasAdded;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Product;
use EventSourcedCatalog\Catalog\Domain\Model\Product\ValueObject\Name;
use EventSourcedCatalog\Testing\Scenarios\Scenario;

class CategoryWasAddedTest extends Scenario
{
    /**
     * @test
     */
    public function category_was_added_scenario(): void
    {
        $name = new Name('Product name');
        $product = Product::create($name);
        $categoryId = CategoryId::new();
        $product->addCategory($categoryId);
        $events = $this->popRecordedEvents($product);

        $this->assertCount(2, $events);
        $this->assertInstanceOf(CategoryWasAdded::class, $events[1]);
    }
}
