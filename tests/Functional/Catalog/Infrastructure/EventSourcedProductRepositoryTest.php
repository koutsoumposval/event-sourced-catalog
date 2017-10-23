<?php
namespace EventSourcedCatalog\Testing\Functional\Catalog\Infrastructure;

use EventSourcedCatalog\Catalog\Domain\Model\Category\CategoryId;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Product;
use EventSourcedCatalog\Catalog\Domain\Model\Product\ProductId;
use EventSourcedCatalog\Catalog\Domain\Model\Product\ValueObject\Name;
use EventSourcedCatalog\Catalog\Infrastructure\EventSourcedProductRepository;
use EventSourcedCatalog\Testing\Traits\MemoryEventStore;
use PHPUnit\Framework\TestCase;

class EventSourcedProductRepositoryTest extends TestCase
{
    use MemoryEventStore;

    public function setUp()
    {
        $this->setUpMemoryEventStore();
    }

    /**
     * @test
     */
    public function it_instantiates_product_repository()
    {
        $productRepository = new EventSourcedProductRepository($this->eventStore);
        $this->assertInstanceOf(EventSourcedProductRepository::class, $productRepository);
    }

    /**
     * @test
     */
    public function it_saves_a_product()
    {
        $productRepository = new EventSourcedProductRepository($this->eventStore);
        $productName = new Name('ProductName');
        $productId = ProductId::new();
        $product = Product::create($productName, $productId);

        $category = CategoryId::new();
        $product->addCategory($category);

        $productRepository->save($product);
        $result = $productRepository->get($productId);

        $this->assertEquals($result->getId(), $product->getId());
        $this->assertEquals($result, $product);
        $this->assertInstanceOf(Product::class, $product);
    }
}
