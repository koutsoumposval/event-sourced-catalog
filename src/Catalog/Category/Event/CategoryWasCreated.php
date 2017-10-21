<?php
namespace EventSourcedCatalog\Catalog\Category\Event;

use EventSourcedCatalog\Common\RootId;
use EventSourcedCatalog\Catalog\Category\CategoryId;
use EventSourcedCatalog\Catalog\Category\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class CategoryWasCreated
 * @package EventSourcedCatalog\Catalog\Category\Events
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class CategoryWasCreated extends AggregateChanged
{
    /**
     * @return CategoryId|RootId
     */
    public function categoryId(): RootId
    {
        return CategoryId::fromString((string) $this->aggregateId());
    }

    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->payload['name'];
    }
}