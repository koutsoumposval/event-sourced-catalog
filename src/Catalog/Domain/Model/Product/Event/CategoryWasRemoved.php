<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Product\Event;

use EventSourcedCatalog\Catalog\Domain\Model\Category\Category;
use Prooph\EventSourcing\AggregateChanged;

/**
 * Class CategoryWasRemoved
 * @package EventSourcedCatalog\Catalog\Domain\Model\Product\Event
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class CategoryWasRemoved extends AggregateChanged
{
    /**
     * @return Category
     */
    public function category(): Category
    {
        return $this->payload['category'];
    }
}