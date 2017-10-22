<?php
namespace EventSourcedCatalog\Domain\Catalog\Model\Category;

/**
 * Interface CategoryRepository
 * @package EventSourcedCatalog\Domain\Catalog\Model\Category
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