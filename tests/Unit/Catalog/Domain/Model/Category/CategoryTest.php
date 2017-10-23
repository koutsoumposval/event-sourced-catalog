<?php
namespace EventSourcedCatalog\Testing\Unit\Catalog\Domain\Model\Category;

use EventSourcedCatalog\Catalog\Domain\Model\Category\Category;
use EventSourcedCatalog\Catalog\Domain\Model\Category\ValueObject\Name;
use EventSourcedCatalog\Catalog\Domain\Exception\CategoryException;
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
        $this->assertEquals($name->getName(), $category->getName()->getName());

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
        $this->assertEquals($newName->getName(), $category->getName()->getName());
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
