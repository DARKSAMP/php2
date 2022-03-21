<?php

namespace Models;

use MyApp\Models\Goods;
use PHPUnit\Framework\TestCase;

class GoodsTest /*extends TestCase*/
{
    public function testGetAll()
    {
        $goodsMockInstance = $this->getGoodsMock();
        $expected = [
            0 => [
                'id' => 1,
                'title' => 'Lenovo',
                'price' => 100,
                'category_id' => 2,
                'info' => 'Info about Lenovo',
            ],
            1 => [
                'id' => 2,
                'title' => 'Samsung',
                'price' => 200,
                'category_id' => 2,
                'info' => 'Info about Samsung',
            ],
            2 => [
                'id' => 3,
                'title' => 'Apple',
                'price' => 1000,
                'category_id' => 2,
                'info' => 'Apple is the most expensive laptop',
            ]
        ];

        self::assertEquals($expected, $goodsMockInstance->getAll());
    }

    public function testGetById()
    {
        $goods = new Goods();
        $expected = [
            'id' => 1,
            'title' => 'Lenovo',
            'price' => 100,
            'category_id' => 2,
            'info' => 'Info about Lenovo',
        ];

        self::assertEquals($expected, $goods->getById(1));
    }

    public function testGetByCategory()
    {
       $goods = new Goods();

       $expected = [
           0 => [
               'id' => 1,
               'title' => 'Lenovo',
               'price' => 100,
               'category_id' => 2,
               'info' => 'Info about Lenovo',
           ],
           1 => [
               'id' => 2,
               'title' => 'Samsung',
               'price' => 200,
               'category_id' => 2,
               'info' => 'Info about Samsung',
           ],
           2 => [
               'id' => 3,
               'title' => 'Apple',
               'price' => 1000,
               'category_id' => 2,
               'info' => 'Apple is the most expensive laptop',
           ]
       ];

       self::assertEquals($expected, $goods->getByCategory(2));
    }

   private function getGoodsMock()
    {
        return new class extends Goods {
            public static function getAll()
            {
                return [
                    0 => [
                        'id' => 1,
                        'title' => 'Lenovo',
                        'price' => 100,
                        'category_id' => 2,
                        'info' => 'Info about Lenovo',
                    ],
                    1 => [
                        'id' => 2,
                        'title' => 'Samsung',
                        'price' => 200,
                        'category_id' => 2,
                        'info' => 'Info about Samsung',
                    ],
                    2 => [
                        'id' => 3,
                        'title' => 'Apple',
                        'price' => 1000,
                        'category_id' => 2,
                        'info' => 'Apple is the most expensive laptop',
                    ]
                ];
            }
        };
    }


}