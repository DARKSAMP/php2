<?php

class FooTest extends \PHPUnit\Framework\TestCase
{
    private $foo;

    /*
     * этот метод вызывается перед каждым тестом
     */
    public function setUp(): void
    {
        $this->foo = new \MyApp\Foo();
    }

    public function tearDown(): void
    {
        unset($this->foo);
    }

    public function testSum()
    {
        self::assertEquals(7, $this->foo->sum(2, 5));
    }

    public function testReturnTrue()
    {
        self::assertTrue($this->foo->returnTrue());
    }

    public function testReturnNull()
    {
        self::assertNull($this->foo->returnNull());
    }

    /**
     * dataProvider указывать обязательно + функцию провайдера
     * @dataProvider getStatusProvider
     * @param $type
     * @param $expected
     */
    public function testGetStatus($type, $expected)
    {
        $foo = new MyApp\Foo($type);
        self::assertEquals($expected, $foo->getStatus());
    }

    // в провайдере данных сначала пишется название метода и
    // к нему добавляется Provider
    public function getStatusProvider()
    {
        return [
            [1, 'one'],
            [2, 'second'],
            [3, 'third'],
            [null, 'Another'],
            [123, 'Another'],
            ['', 'Another'],
        ];
    }
}