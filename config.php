<?php

// файл конфигураци

define('DIR_ROOT', __DIR__);
define('DIR_APP', DIR_ROOT . DIRECTORY_SEPARATOR . 'controller');
define('DIR_MODEL', DIR_ROOT . DIRECTORY_SEPARATOR . 'model');
define('DIR_TEMPLATES', DIR_ROOT . DIRECTORY_SEPARATOR . 'templates');
define('DIR_IMAGES', DIR_ROOT . DIRECTORY_SEPARATOR . 'pictures');
define('DIR_CACHE', DIR_IMAGES . DIRECTORY_SEPARATOR . 'cache');
define('MAX_SIZE_UPLOAD_FILES', '2097152');
define('WIDTH_IMAGE', '200');

/* DB config */
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'mysql');
define('DB', 'gallery');
define('DB_PORT', '3306');