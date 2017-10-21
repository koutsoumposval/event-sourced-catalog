<?php
namespace EventSourcedCatalog\Testing\Scenarios;

use PHPUnit\Framework\TestCase;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\AggregateRoot;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;

/**
 * Class Scenario
 * @package ProjectP\Content\Scenarios
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 * @see http://getprooph.org/docs/html/tutorial/testing_aggregates.html
 */
class Scenario extends TestCase
{
    /**
     * @var AggregateTranslator
     */
    private $aggregateTranslator;

    /**
     * @param AggregateRoot $aggregateRoot
     * @return array
     */
    protected function popRecordedEvents(AggregateRoot $aggregateRoot): array
    {
        return $this->getAggregateTranslator()->extractPendingStreamEvents($aggregateRoot);
    }

    /**
     * @param string $aggregateRootClass
     * @param array $events
     * @return object
     */
    protected function reconstituteAggregateFromHistory(string $aggregateRootClass, array $events)
    {
        return $this->getAggregateTranslator()->reconstituteAggregateFromHistory(
            AggregateType::fromAggregateRootClass($aggregateRootClass),
            new \ArrayIterator($events)
        );
    }

    /**
     * @return AggregateTranslator
     */
    private function getAggregateTranslator(): AggregateTranslator
    {
        if (null === $this->aggregateTranslator) {
            $this->aggregateTranslator = new AggregateTranslator();
        }
        return $this->aggregateTranslator;
    }
}
