<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Category\Event;

use EventSourcedCatalog\Common\Domain\RootId;
use EventSourcedCatalog\Catalog\Domain\Model\Category\CategoryId;
use EventSourcedCatalog\Catalog\Domain\Model\Category\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class CategoryWasCreated
 * @package EventSourcedCatalog\Catalog\Domain\Model\Category\Events
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
        return new Name((string)$this->payload['name']);
    }
}