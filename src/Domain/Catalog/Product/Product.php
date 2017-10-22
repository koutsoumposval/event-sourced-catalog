<?php
namespace EventSourcedCatalog\Domain\Catalog\Product;

use EventSourcedCatalog\Domain\Catalog\Product\Event\ProductWasCreated;
use EventSourcedCatalog\Domain\Catalog\Product\Event\ProductWasRenamed;
use EventSourcedCatalog\Domain\Catalog\Product\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

/**
 * Class Product
 * @package EventSourcedCatalog\Domain\Catalog\Product
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
final class Product extends AggregateRoot
{
    /**
     * @var ProductId
     */
    private $id;

    /**
     * @var Name
     */
    private $name;

    /**
     * @param Name $name
     * @param ProductId|null $productId
     * @return Product
     */
    public static function create(Name $name, ?ProductId $productId = null): Product
    {
        if ($productId === null) {
            $productId = ProductId::new();
        }

        $self = new self();
        $self->recordThat(ProductWasCreated::occur(
            (string)$productId,
            ['name' => $name]
        )
        );
        return $self;
    }

    /**
     * @param Name $name
     */
    public function rename(Name $name): void
    {
        if ($name !== $this->name) {
            $this->recordThat(ProductWasRenamed::occur(
                (string)$this->id,
                ['name' => $name]
            ));
        }
    }

    /**
     * @return string
     */
    protected function aggregateId(): string
    {
        return (string)$this->id;
    }


    /**
     * @param AggregateChanged $event
     */
    protected function apply(AggregateChanged $event): void
    {
        switch ($event->messageName()) {
            case ProductWasCreated::class:
                $this->applyProductWasCreated($event);
                break;
            case ProductWasRenamed::class:
                $this->applyProductWasRenamed($event);
                break;
        }
    }

    /**
     * @param ProductWasCreated $event
     */
    private function applyProductWasCreated(ProductWasCreated $event): void
    {
        $this->id = $event->aggregateId();
        $this->name = $event->name();
    }

    /**
     * @param ProductWasRenamed $event
     */
    private function applyProductWasRenamed(ProductWasRenamed $event): void
    {
        $this->name = $event->name();
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }
}