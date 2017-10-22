<?php
namespace EventSourcedCatalog\Domain\Catalog\Model\Product;

use Doctrine\Common\Collections\ArrayCollection;
use EventSourcedCatalog\Domain\Catalog\Model\Category\Category;
use EventSourcedCatalog\Domain\Catalog\Model\Category\CategoryId;
use EventSourcedCatalog\Domain\Catalog\Model\Product\Event\CategoryWasAdded;
use EventSourcedCatalog\Domain\Catalog\Model\Product\Event\CategoryWasRemoved;
use EventSourcedCatalog\Domain\Catalog\Model\Product\Event\ProductWasCreated;
use EventSourcedCatalog\Domain\Catalog\Model\Product\Event\ProductWasRenamed;
use EventSourcedCatalog\Domain\Catalog\Exception\ProductException;
use EventSourcedCatalog\Domain\Catalog\Model\Product\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

/**
 * Class Product
 * @package EventSourcedCatalog\Domain\Catalog\Model\Product
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
     * @var Category[]|ArrayCollection
     */
    private $categories;

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
     * @throws ProductException
     */
    public function rename(Name $name): void
    {
        if ($name->getName() === $this->name->getName()) {
            throw ProductException::provideDifferentName();
        }
        $this->recordThat(ProductWasRenamed::occur(
            (string)$this->id,
            ['name' => $name]
        ));
    }

    /**
     * @param Category $category
     */
    public function addCategory(Category $category): void
    {
        if ($this->categories->contains($category)) {
            throw ProductException::categoryAlreadyAdded();
        }
        $this->recordThat(CategoryWasAdded::occur(
            (string)$this->id,
            ['category' => $category]
        ));
    }

    /**
     * @param Category $category
     */
    public function removeCategory(Category $category): void
    {
        if (! $this->categories->contains($category)) {
            throw ProductException::notAddedCategory();
        }
        $this->recordThat(CategoryWasRemoved::occur(
            (string)$this->id,
            ['category' => $category]
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
            case CategoryWasAdded::class:
                $this->applyCategoryWasAdded($event);
                break;
            case CategoryWasRemoved::class:
                $this->applyCategoryWasRemoved($event);
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
        $this->categories = new ArrayCollection();
    }

    /**
     * @param ProductWasRenamed $event
     */
    private function applyProductWasRenamed(ProductWasRenamed $event): void
    {
        $this->name = $event->name();
    }

    /**
     * @param CategoryWasAdded $event
     */
    private function applyCategoryWasAdded(CategoryWasAdded $event): void
    {
        $this->categories->add($event->category());
    }

    /**
     * @param CategoryWasRemoved $event
     */
    private function applyCategoryWasRemoved(CategoryWasRemoved $event): void
    {
        $this->categories->removeElement($event->category());
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Category[]|ArrayCollection
     */
    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }


}