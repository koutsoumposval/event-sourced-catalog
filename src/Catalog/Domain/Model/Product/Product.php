<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Product;

use Doctrine\Common\Collections\ArrayCollection;
use EventSourcedCatalog\Catalog\Domain\Model\Category\Category;
use EventSourcedCatalog\Catalog\Domain\Model\Category\CategoryId;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Event\CategoryWasAdded;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Event\CategoryWasRemoved;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Event\ProductWasCreated;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Event\ProductWasRenamed;
use EventSourcedCatalog\Catalog\Domain\Exception\ProductException;
use EventSourcedCatalog\Catalog\Domain\Model\Product\ValueObject\Name;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Prooph\EventStore\Exception\RuntimeException;

/**
 * Class Product
 * @package EventSourcedCatalog\Catalog\Domain\Model\Product
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
     * @var CategoryId[]|ArrayCollection
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
            ['name' => $name->__toString()]
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
            ['name' => $name->__toString()]
        ));
    }

    /**
     * @param CategoryId $categoryId
     */
    public function addCategory(CategoryId $categoryId): void
    {
        if ($this->categoryExists($categoryId)) {
            throw ProductException::categoryAlreadyAdded();
        }
        $this->recordThat(CategoryWasAdded::occur(
            (string)$this->id,
            ['category' => (string)$categoryId]
        ));
    }

    /**
     * @param CategoryId $categoryId
     */
    public function removeCategory(CategoryId $categoryId): void
    {
        if (! $this->categoryExists($categoryId)) {
            throw ProductException::notAddedCategory();
        }
        $this->recordThat(CategoryWasRemoved::occur(
            (string)$this->id,
            ['category' => (string)$categoryId]
        ));
    }

    /**
     * @param CategoryId $categoryId
     * @return bool
     */
    private function categoryExists(CategoryId $categoryId): bool
    {
        return $this->categories->exists(function ($key, $element) use ($categoryId) {
            return (string)$element === (string)$categoryId;
        });
    }


    /**
     * @param CategoryId $categoryId
     * @return mixed
     * @throws ProductException
     */
    private function categoryKey(CategoryId $categoryId)
    {
        foreach ($this->categories as $key => $category) {
            if ((string)$category === (string)$categoryId) {
                return $key;
            }
        }

        throw ProductException::notAddedCategory();
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
        $this->id = ProductId::fromString($event->aggregateId());
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
        $this->categories->remove(
            $this->categoryKey($event->category())
        );
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

    /**
     * @return ProductId
     */
    public function getId(): ProductId
    {
        return $this->id;
    }
}