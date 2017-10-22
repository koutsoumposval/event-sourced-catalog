<?php
namespace EventSourcedCatalog\Domain\Catalog\Model\Product\Event;

use EventSourcedCatalog\Domain\Catalog\Model\Category\Category;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class CategoryWasAdded
 * @package EventSourcedCatalog\Domain\Catalog\Model\Product\Event
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