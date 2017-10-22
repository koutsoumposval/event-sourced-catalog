<?php
namespace EventSourcedCatalog\Domain\Catalog\Product\ValueObject;

use Assert\Assertion;

class Name
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

}