<?php
namespace EventSourcedCatalog\Catalog\Infrastructure;

use EventSourcedCatalog\Catalog\Domain\Model\Product\Product;
use EventSourcedCatalog\Catalog\Domain\Model\Product\ProductId;
use EventSourcedCatalog\Catalog\Domain\Model\Product\ProductRepository;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore;

/**
 * Class EventSourcedProductRepository
 * @package EventSourcedCatalog\Catalog\Infrastructure
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class EventSourcedProductRepository extends AggregateRepository implements ProductRepository
{
    /**
     * EventSourcedCategoryRepository constructor.
     * @param EventStore $eventStore
     */
    public function __construct(EventStore $eventStore)
    {
        parent::__construct(
            $eventStore,
            AggregateType::fromAggregateRootClass(Product::class),
            new AggregateTranslator(),
            null,
            null,
            true
        );
    }

    /**
     * @param Product $product
     */
    public function save(Product $product): void
    {
        $this->saveAggregateRoot($product);
    }

    /**
     * @param ProductId $productId
     * @return Product|null
     */
    public function get(ProductId $productId): ?Product
    {
        return $this->getAggregateRoot($productId->toString());
    }
}