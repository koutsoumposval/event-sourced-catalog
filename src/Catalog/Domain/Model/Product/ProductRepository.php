<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Product;

/**
 * Interface ProductRepository
 * @package EventSourcedCatalog\Catalog\Domain\Model\Product
 */
interface ProductRepository
{
    /**
     * @param Product $product
     */
    public function save(Product $product): void;

    /**
     * @param ProductId $productId
     * @return Product|null
     */
    public function get(ProductId $productId): ?Product;
}