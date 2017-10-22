<?php
namespace EventSourcedCatalog\Domain\Catalog\Product\Event;

use EventSourcedCatalog\Domain\Catalog\Category\Category;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class CategoryWasAdded
 * @package EventSourcedCatalog\Domain\Catalog\Product\Event
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class CategoryWasAdded extends AggregateChanged
{
    /**
     * @return Category
     */
    public function category(): Category
    {
        return $this->payload['category'];
    }
}