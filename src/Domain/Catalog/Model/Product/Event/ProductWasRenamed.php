<?php
namespace EventSourcedCatalog\Domain\Catalog\Model\Product\Event;

use EventSourcedCatalog\Domain\Catalog\Model\Product\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class ProductWasRenamed
 * @package EventSourcedCatalog\Domain\Catalog\Model\Product\Event
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