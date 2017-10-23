<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Product\Event;

use EventSourcedCatalog\Catalog\Domain\Model\Product\ProductId;
use EventSourcedCatalog\Catalog\Domain\Model\Product\ValueObject\Name;
use EventSourcedCatalog\Common\Domain\RootId;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class ProductWasCreated
 * @package EventSourcedCatalog\Catalog\Domain\Model\Product\Event
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
        return new Name((string)$this->payload['name']);
    }
}