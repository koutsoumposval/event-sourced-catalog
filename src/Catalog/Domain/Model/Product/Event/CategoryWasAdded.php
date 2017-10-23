<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Product\Event;

use EventSourcedCatalog\Catalog\Domain\Model\Category\CategoryId;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class CategoryWasAdded
 * @package EventSourcedCatalog\Catalog\Domain\Model\Product\Event
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class CategoryWasAdded extends AggregateChanged
{
    /**
     * @return CategoryId
     */
    public function category(): CategoryId
    {
        return CategoryId::fromString($this->payload['category']);
    }
}