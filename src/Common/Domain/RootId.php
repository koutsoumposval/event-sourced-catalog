<?php
namespace EventSourcedCatalog\Common\Domain;

use InvalidArgumentException;
use JsonSerializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class RootId
 * @package EventSourcedCatalog\Common
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
abstract class RootId implements JsonSerializable
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * Prevent directly instantiating the id
     * @param UuidInterface $uuid
     */
    protected function __construct(UuidInterface $uuid)
    {
        $this->id = $uuid;
    }

    /**
     * @return RootId
     */
    public static function new(): self
    {
        return new static(Uuid::uuid4());
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

        return new static(Uuid::fromString($uuidString));
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

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return $this->__toString();
    }
}