<?php
namespace EventSourcedCatalog\Testing\Functional\Domain\Catalog\Model\Product\Event;

use EventSourcedCatalog\Domain\Catalog\Model\Category\Category;
use EventSourcedCatalog\Domain\Catalog\Model\Product\Event\CategoryWasRemoved;
use EventSourcedCatalog\Domain\Catalog\Model\Product\Product;
use EventSourcedCatalog\Domain\Catalog\Model\Product\ValueObject\Name;
use EventSourcedCatalog\Domain\Catalog\Model\Category\ValueObject\Name as CategoryName;
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
        $categoryName = new CategoryName('Category Name');
        $category = Category::create($categoryName);
        $product->addCategory($category);
        $product->removeCategory($category);
        $events = $this->popRecordedEvents($product);

        $this->assertCount(3, $events);
        $this->assertInstanceOf(CategoryWasRemoved::class, $events[2]);
    }
}
