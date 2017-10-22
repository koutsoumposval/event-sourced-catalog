<?php
namespace EventSourcedCatalog\Domain\Catalog\Product\Event;

use EventSourcedCatalog\Domain\Catalog\Product\ProductId;
use EventSourcedCatalog\Domain\Catalog\Product\ValueObject\Name;
use EventSourcedCatalog\Domain\Common\RootId;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class ProductWasCreated
 * @package EventSourcedCatalog\Domain\Catalog\Product\Event
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class ProductWasCreated extends AggregateChanged
{
    /**
     * @return RootId
     */
    public function productId(): RootId
    {
        return ProductId::fromString((string) $this->aggregateId());
    }

    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->payload['name'];
    }
}