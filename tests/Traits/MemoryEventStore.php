<?php
namespace EventSourcedCatalog\Testing\Traits;

use Prooph\Common\Event\ProophActionEventEmitter;
use Prooph\EventStore\InMemoryEventStore;
use Prooph\EventStore\TransactionalActionEventEmitterEventStore;

/**
 * Trait MemoryEventStore
 * @package EventSourcedCatalog\Testing\Traits
 */
trait MemoryEventStore
{
    /**
     * @var TransactionalActionEventEmitterEventStore
     */
    private $eventStore;

    public function setUpMemoryEventStore()
    {
        $this->eventStore = new TransactionalActionEventEmitterEventStore(
            new InMemoryEventStore(),
            new ProophActionEventEmitter()
        );
    }
}