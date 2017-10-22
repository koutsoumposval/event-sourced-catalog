<?php
namespace EventSourcedCatalog\Testing\Functional\Catalog\Domain\Model\Category\Event;

use EventSourcedCatalog\Catalog\Domain\Model\Category\Category;
use EventSourcedCatalog\Catalog\Domain\Model\Category\Event\CategoryWasRenamed;
use EventSourcedCatalog\Catalog\Domain\Model\Category\ValueObject\Name;
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
