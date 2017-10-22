<?php
namespace EventSourcedCatalog\Testing\Functional\Domain\Catalog\Category\Event;

use EventSourcedCatalog\Domain\Catalog\Category\Category;
use EventSourcedCatalog\Domain\Catalog\Category\Event\CategoryWasCreated;
use EventSourcedCatalog\Domain\Catalog\Category\ValueObject\Name;
use EventSourcedCatalog\Testing\Scenarios\Scenario;

class CategoryWasCreatedTest extends Scenario
{
    /**
     * @test
     */
    public function category_was_created_scenario(): void
    {
        $name = new Name('Category name');
        $category = Category::create($name);
        $events = $this->popRecordedEvents($category);

        $this->assertCount(1, $events);
        $this->assertInstanceOf(CategoryWasCreated::class, $events[0]);
    }
}
