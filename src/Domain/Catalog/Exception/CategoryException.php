<?php
namespace EventSourcedCatalog\Domain\Catalog\Exception;

use RuntimeException;

/**
 * Class CategoryException
 * @package EventSourcedCatalog\Domain\Catalog\Exception
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class CategoryException extends RuntimeException
{
    /**
     * @return CategoryException
     */
    public static function provideDifferentName(): CategoryException
    {
        return new self('You must provide a different category name');
    }
}