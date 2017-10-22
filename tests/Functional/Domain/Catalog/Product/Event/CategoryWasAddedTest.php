<?php
namespace EventSourcedCatalog\Testing\Functional\Domain\Catalog\Product\Event;

use EventSourcedCatalog\Domain\Catalog\Category\Category;
use EventSourcedCatalog\Domain\Catalog\Category\ValueObject\Name as CategoryName;
use EventSourcedCatalog\Domain\Catalog\Product\Event\CategoryWasAdded;
use EventSourcedCatalog\Domain\Catalog\Product\Product;
use EventSourcedCatalog\Domain\Catalog\Product\ValueObject\Name;
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
        $categoryName = new CategoryName('Category Name');
        $category = Category::create($categoryName);
        $product->addCategory($category);
        $events = $this->popRecordedEvents($product);

        $this->assertCount(2, $events);
        $this->assertInstanceOf(CategoryWasAdded::class, $events[1]);
    }
}
