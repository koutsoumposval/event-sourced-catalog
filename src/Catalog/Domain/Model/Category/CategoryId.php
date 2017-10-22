<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Category;

use EventSourcedCatalog\Common\Domain\RootId;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

/**
 * Class CategoryId
 * @package EventSourcedCatalog\Catalog\Domain\Model\Category
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
final class CategoryId extends RootId
{
    /**
     * @return CategoryId
     */
    public static function new(): self
    {
        return new self(Uuid::uuid4());
    }

    /**
     * @param string $uuidString
     * @return CategoryId
     */
    public static function fromString(string $uuidString): self
    {
        if (! Uuid::isValid($uuidString)) {
            throw new InvalidArgumentException("Given id is not a UUID, got '$uuidString'");
        }

        return new self(Uuid::fromString($uuidString));
    }
}