<?php
namespace EventSourcedCatalog\Testing\Dummy\Common\Domain;

use EventSourcedCatalog\Common\Domain\RootId;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

/**
 * Class TestRootId
 * @package EventSourcedCatalog\Testing\Dummy\Common\Domain
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
final class TestRootId extends RootId
{
    /**
     * @return TestRootId
     */
    public static function new(): self
    {
        return new self(Uuid::uuid4());
    }

    /**
     * @param string $uuidString
     * @return TestRootId
     */
    public static function fromString(string $uuidString): self
    {
        if (! Uuid::isValid($uuidString)) {
            throw new InvalidArgumentException("Given id is not a UUID, got '$uuidString'");
        }

        return new self(Uuid::fromString($uuidString));
    }
}