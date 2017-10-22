<?php
namespace EventSourcedCatalog\Domain\Catalog\Model\Product;

/**
 * Interface ProductRepository
 * @package EventSourcedCatalog\Domain\Catalog\Model\Product
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