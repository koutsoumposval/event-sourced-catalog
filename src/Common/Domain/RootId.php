<?php
namespace EventSourcedCatalog\Common\Domain;

use Ramsey\Uuid\UuidInterface;

/**
 * Class RootId
 * @package EventSourcedCatalog\Common
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
abstract class RootId implements \JsonSerializable
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
     * @return mixed
     */
    abstract public static function new();

    /**
     * @param string $uuidString
     * @return mixed
     */
    abstract public static function fromString(string $uuidString);

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