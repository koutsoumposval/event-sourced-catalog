<?php
namespace EventSourcedCatalog\Catalog\Infrastructure;

use EventSourcedCatalog\Catalog\Domain\Model\Category\Category;
use EventSourcedCatalog\Catalog\Domain\Model\Category\CategoryId;
use EventSourcedCatalog\Catalog\Domain\Model\Category\CategoryRepository;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore;

/**
 * Class EventSourcedCategoryRepository
 * @package EventSourcedCatalog\Catalog\Infrastructure
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class EventSourcedCategoryRepository extends AggregateRepository implements CategoryRepository
{
    /**
     * EventSourcedCategoryRepository constructor.
     * @param EventStore $eventStore
     */
    public function __construct(EventStore $eventStore)
    {
        parent::__construct(
            $eventStore,
            AggregateType::fromAggregateRootClass(Category::class),
            new AggregateTranslator(),
            null,
            null,
            true
        );
    }

    /**
     * @param Category $category
     */
    public function save(Category $category): void
    {
        $this->saveAggregateRoot($category);
    }

    /**
     * @param CategoryId $categoryId
     * @return Category|null
     */
    public function get(CategoryId $categoryId): ?Category
    {
        return $this->getAggregateRoot($categoryId->toString());
    }
}