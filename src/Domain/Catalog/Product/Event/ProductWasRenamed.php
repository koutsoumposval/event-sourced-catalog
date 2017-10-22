<?php
namespace EventSourcedCatalog\Domain\Catalog\Product\Event;

use EventSourcedCatalog\Domain\Catalog\Product\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class ProductWasRenamed
 * @package EventSourcedCatalog\Domain\Catalog\Product\Event
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class ProductWasRenamed extends AggregateChanged
{
    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->payload['name'];
    }
}