<?php
namespace EventSourcedCatalog\Catalog\Category;

/**
 * Interface CategoryRepository
 * @package EventSourcedCatalog\Catalog\Category
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