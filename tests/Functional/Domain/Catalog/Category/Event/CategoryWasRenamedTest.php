<?php
namespace EventSourcedCatalog\Testing\Functional\Domain\Catalog\Category\Event;

use EventSourcedCatalog\Domain\Catalog\Category\Category;
use EventSourcedCatalog\Domain\Catalog\Category\Event\CategoryWasRenamed;
use EventSourcedCatalog\Domain\Catalog\Category\ValueObject\Name;
use EventSourcedCatalog\Testing\Scenarios\Scenario;

class CategoryWasRenamedTest extends Scenario
{
    /**
     * @test
     */
    public function category_was_renamed_scenario(): void
    {
        $name = new Name('Category name');
        $category = Category::create($name);
        $newName = new Name('New category name');
        $category->rename($newName);
        $events = $this->popRecordedEvents($category);

        $this->assertCount(2, $events);
        $this->assertInstanceOf(CategoryWasRenamed::class, $events[1]);
    }
}
