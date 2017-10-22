<?php
namespace EventSourcedCatalog\Domain\Catalog\Model\Category\Event;

use EventSourcedCatalog\Domain\Catalog\Model\Category\ValueObject\Name;
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