<?php

class BasketTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        $_SESSION['basket'] = null;
    }

    public function testGet()
    {
        $actual = \MyApp\Basket::get();

        self::assertEquals([
            'count' => 0,
            'goods' => [],
        ], $actual);
    }

    public function testClear()
    {
        $_SESSION['basket'] = [
            'count' => 1,
            'goods' => [3 => 1],
        ];

        \MyApp\Basket::clear();
        self::assertEquals([
            'count' => 0,
            'goods' => [],
        ], $_SESSION['basket']);

    }

    public static function testAdd()
    {
        \MyApp\Basket::add(2);
        \MyApp\Basket::add(3);
        \MyApp\Basket::add(1);
        \MyApp\Basket::add(2);

        $basket = \MyApp\Basket::get();

        self::assertEquals([
            'count' => 4,
            'goods' => [
                2 => 2,
                3 => 1,
                1 => 1,
            ],
        ], $basket);
    }

    /**
     * @dataProvider initProvider
     * @param $initialProvider
     * @param $force
     * @param $expectedBasket
     */
    public function testInit($initialProvider, $force, $expectedBasket)
    {
        $_SESSION['basket'] = $initialProvider;

        \MyApp\Basket::init($force);

        self::assertEquals($expectedBasket, $_SESSION['basket']);
    }

    public function initProvider()
    {
        $empty = null;
        $nonEmpty = [
            'count' => 1,
            'goods' => [3 => 1],
        ];
        $initedBasket = [
            'count' => 0,
            'goods' => [],
        ];

        return [
            [$empty, false, $initedBasket],
            [$empty, true, $initedBasket],
            [$nonEmpty, false, $nonEmpty],
            [$nonEmpty, true, $initedBasket],
        ];
    }
}