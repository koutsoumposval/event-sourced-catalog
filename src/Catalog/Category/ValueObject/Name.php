<?php
namespace EventSourcedCatalog\Catalog\Category\ValueObject;

use Assert\Assertion;
use Assert\InvalidArgumentException;

/**
 * Class Name
 * @package EventSourcedCatalog\Catalog\Category\ValueObject
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class Name
{
    /**
     * @var string
     */
    private $name;

    /**
     * Name constructor.
     * @param string $name
     * @throws InvalidArgumentException
     */
    public function __construct(string $name)
    {
        Assertion::notEmpty(trim($name), 'You must provide a category Name');
        $this->name = trim($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}