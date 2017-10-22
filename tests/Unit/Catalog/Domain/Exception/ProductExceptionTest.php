<?php
namespace EventSourcedCatalog\Testing\Unit\Catalog\Domain\Exception;

use EventSourcedCatalog\Catalog\Domain\Exception\ProductException;
use PHPUnit\Framework\TestCase;

class ProductExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_formats_provide_different_name_exception()
    {
        $this->expectException(ProductException::class);
        $this->expectExceptionMessage('You must provide a different product name');
        throw ProductException::provideDifferentName();
    }

    /**
     * @test
     */
    public function it_formats_category_already_added_exception()
    {
        $this->expectException(ProductException::class);
        $this->expectExceptionMessage('This category is already added to this product');
        throw ProductException::categoryAlreadyAdded();
    }

    /**
     * @test
     */
    public function it_formats_not_added_category_exception()
    {
        $this->expectException(ProductException::class);
        $this->expectExceptionMessage('Product does not contain the category you are trying to remove');
        throw ProductException::notAddedCategory();
    }
}
