<?php
namespace EventSourcedCatalog\Testing\Unit\Domain\Catalog\Product;

use EventSourcedCatalog\Domain\Catalog\Product\Product;
use EventSourcedCatalog\Domain\Catalog\Product\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * @test
     * @return Product
     */
    public function it_creates_a_product(): Product
    {
        $name = new Name('Product Name');

        $product = Product::create($name);
        $this->assertInstanceOf(Product::class, $product);
        $this->assertSame($name, $product->getName());

        return $product;
    }

    /**
     * @test
     * @depends it_creates_a_product
     * @param Product $product
     */
    public function it_renames_a_product(Product $product): void
    {
        $newName = new Name('New Product Name');

        $product->rename($newName);
        $this->assertSame($newName, $product->getName());
    }
}
