<?php
namespace EventSourcedCatalog\Domain\Catalog\Category\Event;

use EventSourcedCatalog\Domain\Catalog\Category\ValueObject\Name;
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