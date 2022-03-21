<?php
/*
 * Настройки принято хранить в отдельном файле
 * т.к. на локальном компьютере и продакшене могут отличаться настройки
 * и именно из-за этого делают несколько конфигурационных файлов
 * для удобства разработки приложений.
 */

return [
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=goods',
        'user' => 'root',
        'pwd' => '743752As',
    ],
    'templates' => __DIR__ . '/../templates',
    'goodsImages' => [
        'dir' => __DIR__ . '/../public/src/images/goods',
        'url' => '/src/images/goods',
    ],
    'routing' => [
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
    ],
];