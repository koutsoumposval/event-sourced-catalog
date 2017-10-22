<?php
namespace EventSourcedCatalog\Testing\Unit\Domain\Catalog\Category;

use EventSourcedCatalog\Domain\Catalog\Category\Category;
use EventSourcedCatalog\Domain\Catalog\Category\ValueObject\Name;
use EventSourcedCatalog\Domain\Catalog\Exception\CategoryException;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @test
     * @return Category
     */
    public function it_creates_a_category(): Category
    {
        $name = new Name('Category Name');

        $category = Category::create($name);
        $this->assertInstanceOf(Category::class, $category);
        $this->assertSame($name, $category->getName());

        return $category;
    }

    /**
     * @test
     * @depends it_creates_a_category
     * @param Category $category
     */
    public function it_renames_a_category(Category $category): void
    {
        $newName = new Name('New Category Name');

        $category->rename($newName);
        $this->assertSame($newName, $category->getName());
    }

    /**
     * @test
     * @depends it_creates_a_category
     * @param Category $category
     */
    public function it_throws_exception_when_trying_to_rename_a_category_with_same_name(Category $category): void
    {
        $newName = new Name('New Category Name');

        $this->expectException(CategoryException::class);
        $this->expectExceptionMessage('You must provide a different category name');
        $category->rename($newName);
    }
}
