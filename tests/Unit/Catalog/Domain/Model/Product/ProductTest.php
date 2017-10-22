<?php
namespace EventSourcedCatalog\Testing\Unit\Catalog\Domain\Model\Product;

use EventSourcedCatalog\Catalog\Domain\Model\Category\Category;
use EventSourcedCatalog\Catalog\Domain\Exception\ProductException;
use EventSourcedCatalog\Catalog\Domain\Model\Product\Product;
use EventSourcedCatalog\Catalog\Domain\Model\Product\ValueObject\Name;
use EventSourcedCatalog\Catalog\Domain\Model\Category\ValueObject\Name as CategoryName;
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

    /**
     * @test
     * @depends it_creates_a_product
     * @param Product $product
     */
    public function it_throws_exception_when_trying_to_rename_a_product_with_same_name(Product $product): void
    {
        $newName = new Name('New Product Name');

        $this->expectException(ProductException::class);
        $this->expectExceptionMessage('You must provide a different product name');
        $product->rename($newName);
    }

    /**
     * @test
     * @depends it_creates_a_product
     * @param Product $product
     */
    public function it_adds_a_category(Product $product): void
    {
        $categoryName = new CategoryName('Category Name');
        $category = Category::create($categoryName);
        $product->addCategory($category);

        $this->assertCount(1, $product->getCategories());
        $this->assertSame($category, $product->getCategories()->first());
        $this->assertInstanceOf(Category::class, $product->getCategories()->first());
    }

    /**
     * @test
     * @depends it_creates_a_product
     * @param Product $product
     */
    public function it_throws_exception_when_trying_to_add_the_same_category_twice(Product $product)
    {
        $categoryName = new CategoryName('New category Name');
        $category = Category::create($categoryName);
        $product->addCategory($category);

        $this->assertCount(2, $product->getCategories());
        $this->expectException(ProductException::class);
        $this->expectExceptionMessage('This category is already added to this product');
        $product->addCategory($category);
    }

    /**
     * @test
     */
    public function it_removes_a_category()
    {
        $name = new Name('Product Name');
        $product = Product::create($name);
        $categoryName = new CategoryName('Category Name');
        $category = Category::create($categoryName);
        $category2Name = new CategoryName('Category 2 Name');
        $category2 = Category::create($category2Name);
        $product->addCategory($category);
        $product->addCategory($category2);
        $this->assertCount(2, $product->getCategories());

        $product->removeCategory($category2);
        $this->assertCount(1, $product->getCategories());
        $this->assertSame($category, $product->getCategories()->first());

        $product->removeCategory($category);
        $this->assertEmpty($product->getCategories());
    }

    /**
     * @test
     */
    public function it_throws_exception_when_trying_to_remove_a_non_related_category()
    {
        $name = new Name('Product Name');
        $product = Product::create($name);
        $categoryName = new CategoryName('Category Name');
        $category = Category::create($categoryName);

        $this->expectException(ProductException::class);
        $this->expectExceptionMessage('Product does not contain the category you are trying to remove');
        $product->removeCategory($category);
    }
}
