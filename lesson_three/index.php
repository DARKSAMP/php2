<?php

require "DB.php";
require "vendor/autoload.php";

if (isset($_GET['id']) && ($id = $_GET['id'])) {

}

$images = $one = null;

if (
    !isset($_GET['id'])
    || !($one = DB::getInstance()->getById(DB::TABLE_IMAGES, $_GET['id']))
) {
    $images = DB::getInstance()->getAllData(DB::TABLE_IMAGES);
}


$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.twig', [
    "images" => $images,
    "one" => $one,
]);