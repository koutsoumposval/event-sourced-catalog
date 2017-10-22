<?php
namespace EventSourcedCatalog\Testing\Unit\Domain\Catalog\Category;

use EventSourcedCatalog\Domain\Catalog\Category\Category;
use EventSourcedCatalog\Domain\Catalog\Category\ValueObject\Name;
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
}
