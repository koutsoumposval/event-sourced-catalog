<?php
namespace EventSourcedCatalog\Testing\Unit\Catalog\Domain\Exception;

use EventSourcedCatalog\Catalog\Domain\Exception\CategoryException;
use PHPUnit\Framework\TestCase;

class CategoryExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_formats_provide_different_name_exception()
    {
        $this->expectException(CategoryException::class);
        $this->expectExceptionMessage('You must provide a different category name');
        throw CategoryException::provideDifferentName();
    }
}
