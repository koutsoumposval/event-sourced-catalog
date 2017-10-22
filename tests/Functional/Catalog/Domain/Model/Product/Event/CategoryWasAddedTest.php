<?php
namespace EventSourcedCatalog\Testing\Functional\Catalog\Domain\Model\Product\Event;

use EventSourcedCatalog\Catalog\Domain\Model\Category\Category;
use EventSourcedCatalog\Catalog\Domain\Model\Category\ValueObject\Name as CategoryName;
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
        $categoryName = new CategoryName('Category Name');
        $category = Category::create($categoryName);
        $product->addCategory($category);
        $events = $this->popRecordedEvents($product);

        $this->assertCount(2, $events);
        $this->assertInstanceOf(CategoryWasAdded::class, $events[1]);
    }
}
