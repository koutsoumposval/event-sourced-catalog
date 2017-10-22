<?php
namespace EventSourcedCatalog\Catalog\Domain\Model\Product\ValueObject;

use Assert\Assertion;

class Name implements \JsonSerializable
{
    /**
     * @var string
     */
    private $name;

    /**
     * Name constructor.
     * @param string $name
     * TODO Assert unique product Name - Create Exception/ProductException
     */
    public function __construct(string $name)
    {
        Assertion::notEmpty(trim($name), 'You must provide a product Name');
        $this->name = trim($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return $this->__toString();
    }
}