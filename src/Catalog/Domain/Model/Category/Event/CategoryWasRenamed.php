<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Category\Event;

use EventSourcedCatalog\Catalog\Domain\Model\Category\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;

class CategoryWasRenamed extends AggregateChanged
{
    /**
     * @return Name
     */
    public function name(): Name
    {
        return new Name((string)$this->payload['name']);
    }
}