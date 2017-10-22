<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Category;

use EventSourcedCatalog\Catalog\Domain\Model\Category\Event\CategoryWasCreated;
use EventSourcedCatalog\Catalog\Domain\Model\Category\Event\CategoryWasRenamed;
use EventSourcedCatalog\Catalog\Domain\Model\Category\ValueObject\Name;
use EventSourcedCatalog\Catalog\Domain\Exception\CategoryException;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

/**
 * Class Category
 * @package EventSourcedCatalog\Catalog\Domain\Model\Category
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
final class Category extends AggregateRoot
{
    /**
     * @var CategoryId
     */
    private $id;

    /**
     * @var Name
     */
    private $name;

    /**
     * @param Name $name
     * @param CategoryId|null $categoryId
     * @return Category
     */
    public static function create(Name $name, ?CategoryId $categoryId = null): Category
    {
        if ($categoryId === null) {
            $categoryId = CategoryId::new();
        }

        $self = new self();
        $self->recordThat(CategoryWasCreated::occur(
            (string)$categoryId,
            ['name' => $name]
        )
        );
        return $self;
    }

    /**
     * @param Name $name
     * @throws CategoryException
     */
    public function rename(Name $name): void
    {
        if ($name->getName() === $this->name->getName()) {
            throw CategoryException::provideDifferentName();
        }

        $this->recordThat(CategoryWasRenamed::occur(
            (string)$this->id,
            ['name' => $name]
        ));
    }

    /**
     * @return string
     */
    protected function aggregateId(): string
    {
        return (string)$this->id;
    }


    /**
     * Apply given event
     * @param AggregateChanged $event
     */
    protected function apply(AggregateChanged $event): void
    {
        switch ($event->messageName()) {
            case CategoryWasCreated::class:
                $this->applyCategoryWasCreated($event);
                break;
            case CategoryWasRenamed::class:
                $this->applyCategoryWasRenamed($event);
                break;
        }
    }

    /**
     * @param CategoryWasCreated $event
     */
    private function applyCategoryWasCreated(CategoryWasCreated $event): void
    {
        $this->id = CategoryId::fromString($event->aggregateId());
        $this->name = $event->name();
    }

    /**
     * @param CategoryWasRenamed $event
     */
    private function applyCategoryWasRenamed(CategoryWasRenamed $event): void
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

    /**
     * @return CategoryId
     */
    public function getId(): CategoryId
    {
        return $this->id;
    }
}