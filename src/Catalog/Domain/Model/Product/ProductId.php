<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Product;

use EventSourcedCatalog\Common\Domain\RootId;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

/**
 * Class ProductId
 * @package EventSourcedCatalog\Catalog\Domain\Model\Product
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
final class ProductId extends RootId
{
    /**
     * @return ProductId
     */
    public static function new(): self
    {
        return new self(Uuid::uuid4());
    }

    /**
     * @param string $uuidString
     * @return ProductId
     */
    public static function fromString(string $uuidString): self
    {
        if (! Uuid::isValid($uuidString)) {
            throw new InvalidArgumentException("Given id is not a UUID, got '$uuidString'");
        }

        return new self(Uuid::fromString($uuidString));
    }
}