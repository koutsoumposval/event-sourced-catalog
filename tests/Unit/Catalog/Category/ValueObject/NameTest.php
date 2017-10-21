<?php
namespace EventSourcedCatalog\Testing\Unit\Catalog\Category\ValueObject;

use Assert\InvalidArgumentException;
use EventSourcedCatalog\Catalog\Category\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    /**
     * @test
     */
    public function it_instantiates_name()
    {
        $categoryName = 'Category Name';
        $name = new Name($categoryName);

        $this->assertInstanceOf(Name::class, $name);
        $this->assertSame($categoryName, $name->getName());
    }

    /**
     * @test
     * @dataProvider invalidNamesProvider
     * @param string $name
     */
    public function it_throws_exception_on_empty_name(string $name)
    {
        $this->expectException(InvalidArgumentException::class);
        new Name($name);
    }

    /**
     * @return array
     */
    public function invalidNamesProvider(): array
    {
        return [
            [''],
            [' '],
            ['  '],
        ];
    }
}
