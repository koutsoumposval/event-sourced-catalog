<?php
namespace EventSourcedCatalog\Common;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class RootId
 * @package EventSourcedCatalog\Common
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class RootId
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * Prevent directly instantiating the id
     * @param UuidInterface $uuid
     */
    private function __construct(UuidInterface $uuid)
    {
        $this->id = $uuid;
    }

    /**
     * @return RootId
     */
    public static function new(): self
    {
        return new self(Uuid::uuid1());
    }

    /**
     * @param string $uuidString
     * @return RootId
     */
    public static function fromString(string $uuidString): self
    {
        if (! Uuid::isValid($uuidString)) {
            throw new InvalidArgumentException("Given id is not a UUID, got '$uuidString'");
        }

        return new self(Uuid::fromString($uuidString));
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return (string)$this->id;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}