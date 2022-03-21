<?php


class RouterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider parseProvider
     * @param $url
     * @param $expected
     */
    public function testParse($url, $expected)
    {
        $router = new \MyApp\Router([
            'login' => 'account/login',
            'logout' => 'account/logout',
            'basket' => 'account/basket',
            'order' => 'account/order',
            'catalog\/([0-9]+)\/([0-9]+)' => 'catalog/good',
            'catalog\/([0-9]+)' => 'catalog/category',
            'catalog' => 'catalog/index',
            '(\w+)\/(\w+)' => '<controller>/<action>',
            '(\w+)' => '<controller>/index',
            '^$' => 'index/index',
            '(.*)' => 'index/error',
        ]);

        self::assertEquals($expected, $router->parse($url));
    }

    public function parseProvider()
    {
        return [
            ['/login', ['account', 'login', []] ],
            ['/catalog', ['catalog', 'index', []] ],
            ['/catalog/1/2', ['catalog', 'good', ['1', '2']] ],
            ['/', ['index', 'index', []] ],
            ['foo/bar', ['foo', 'bar', []] ],
            ['foo', ['foo', 'index', []] ],
        ];
    }

    /**
     * @dataProvider filterProvider
     * @param $url
     * @param $expected
     */

    public function testFilter($url, $expected)
    {
        //Для статических функций экземпляр класса можно не создавать
        //Т.К. в функции filter необходимо сменить на время тестирования
        //private - public

       self::assertEquals($expected, \MyApp\Router::filter($url));
    }

    public function filterProvider()
    {
        return [
            ['//catalog///234/245///', 'catalog/234/245'],
            ['catalog', 'catalog'],
            ['', ''],
            ['/', ''],
        ];
    }
}