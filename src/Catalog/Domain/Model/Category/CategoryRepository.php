<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Category;

/**
 * Interface CategoryRepository
 * @package EventSourcedCatalog\Catalog\Domain\Model\Category
 */
interface CategoryRepository
{
    /**
     * @param Category $category
     */
    public function save(Category $category): void;

    /**
     * @param CategoryId $categoryId
     * @return Category|null
     */
    public function get(CategoryId $categoryId): ?Category;
}