<?php
namespace EventSourcedCatalog\Testing\Functional\Catalog\Infrastructure;

use EventSourcedCatalog\Catalog\Domain\Model\Category\Category;
use EventSourcedCatalog\Catalog\Domain\Model\Category\CategoryId;
use EventSourcedCatalog\Catalog\Domain\Model\Category\ValueObject\Name;
use EventSourcedCatalog\Catalog\Infrastructure\EventSourcedCategoryRepository;
use EventSourcedCatalog\Testing\Traits\MemoryEventStore;
use PHPUnit\Framework\TestCase;

class EventSourcedCategoryRepositoryTest extends TestCase
{
    use MemoryEventStore;

    public function setUp()
    {
        $this->setUpMemoryEventStore();
    }

    /**
     * @test
     */
    public function it_instantiates_category_repository()
    {
        $categoryRepository = new EventSourcedCategoryRepository($this->eventStore);
        $this->assertInstanceOf(EventSourcedCategoryRepository::class, $categoryRepository);
    }

    /**
     * @test
     */
    public function it_saves_a_category()
    {
        $this->markTestSkipped('Known problem in prooph/common dependency');

        $categoryRepository = new EventSourcedCategoryRepository($this->eventStore);
        $categoryName = new Name('CategoryName');
        $categoryId = CategoryId::new();
        $category = Category::create($categoryName, $categoryId);
        $categoryRepository->save($category);
        $result = $categoryRepository->get($categoryId);

        $this->assertEquals($result->getId(), $category->getId());
        $this->assertEquals($result, $category);
        $this->assertInstanceOf(Category::class, $category);
    }
}
