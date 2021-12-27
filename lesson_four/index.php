<?php

require "DBConnect.php";
require "../vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$limit = 5;


if (isset($_GET['from'])) {
    $count = DBConnect::getInstance()->getCount(DBConnect::TABLE_GOODS);
    $loaded = $_GET['from'] + $limit;

    $all = $loaded >= $count;

    $goods = DBConnect::getInstance()->getShowMore(DBConnect::TABLE_GOODS, $_GET['from'], $limit);
    echo $twig->render('goods.twig', [
        "goods" => $goods,
        'all' => $all,
    ]);
    exit;
}

$goods = DBConnect::getInstance()->getAllData(DBConnect::TABLE_GOODS);

echo $twig->render('index.twig', [
    "goods" => $goods,
    "limit" => $limit,
]);


