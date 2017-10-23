<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Product\Event;

use EventSourcedCatalog\Catalog\Domain\Model\Product\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class ProductWasRenamed
 * @package EventSourcedCatalog\Catalog\Domain\Model\Product\Event
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class ProductWasRenamed extends AggregateChanged
{
    /**
     * @return Name
     */
    public function name(): Name
    {
        return new Name((string)$this->payload['name']);
    }
}