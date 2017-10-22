<?php
namespace EventSourcedCatalog\Domain\Catalog\Model\Category\Event;

use EventSourcedCatalog\Domain\Common\RootId;
use EventSourcedCatalog\Domain\Catalog\Model\Category\CategoryId;
use EventSourcedCatalog\Domain\Catalog\Model\Category\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class CategoryWasCreated
 * @package EventSourcedCatalog\Domain\Catalog\Model\Category\Events
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