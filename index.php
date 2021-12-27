<?php
/*
1. Создать галерею изображений, состоящую из двух страниц:

Просмотр всех фотографий (уменьшенных копий);
Просмотр конкретной фотографии (изображение оригинального размера)
Все страницы вывода на экран - это twig-шаблоны. Вся логика - на бэкенде.
(со звёздочкой) Реализовать хранение ссылок и информации по картинкам в БД
*/

require_once 'config.php';
require_once 'system' . DIRECTORY_SEPARATOR . 'route.php';
require_once 'system' . DIRECTORY_SEPARATOR . 'model.php';
require_once 'system' . DIRECTORY_SEPARATOR . 'view.php';
require_once 'system' . DIRECTORY_SEPARATOR . 'db.php';


Route::start($_SERVER['REQUEST_URI']);


//$db = new DB(HOST, USER, PASS, DB);
//$qr = $db->query("select * from image");
//
//echo '<pre>';
//print_r($qr);



//$action = new Action();