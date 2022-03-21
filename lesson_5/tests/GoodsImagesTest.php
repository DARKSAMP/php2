<?php

class GoodsImagesTest extends \PHPUnit\Framework\TestCase
{
    function testGetImagesUrls()
    {
        $gi = new \MyApp\GoodsImages([
            'dir' => __DIR__ . '/data/goodsImages',
            'url' => '/goods',
        ]);

        $images = $gi->getImagesUrls(1);
        self::assertEquals(['/goods/1/lenovo.jpg',], $images);

        $empty = $gi->getImagesUrls(5);

        self::assertIsArray($empty);
        self::assertEmpty($empty);
    }
}