<?php
namespace EventSourcedCatalog\Domain\Catalog\Exception;

use RuntimeException;

/**
 * Class ProductException
 * @package EventSourcedCatalog\Domain\Catalog\Exception
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class ProductException extends RuntimeException
{
    /**
     * @return ProductException
     */
    public static function provideDifferentName(): ProductException
    {
        return new self('You must provide a different product name');
    }

    /**
     * @return ProductException
     */
    public static function categoryAlreadyAdded(): ProductException
    {
        return new self('This category is already added to this product');
    }

    /**
     * @return ProductException
     */
    public static function notAddedCategory(): ProductException
    {
        return new self('Product does not contain the category you are trying to remove');
    }
}