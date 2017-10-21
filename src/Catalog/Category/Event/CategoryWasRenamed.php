<?php
namespace EventSourcedCatalog\Catalog\Category\Event;

use EventSourcedCatalog\Catalog\Category\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;

class CategoryWasRenamed extends AggregateChanged
{
    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->payload['name'];
    }
}