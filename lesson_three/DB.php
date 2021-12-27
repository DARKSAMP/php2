<?php

class DB
{
    public const TABLE_IMAGES = 'image_data';
    private static $config = [
        'host' => 'localhost',
        'user' => 'root',
        'pwd' => 'root',
        'db' => 'images',
        'port' => '3307'
    ];

    private static $instance;
    private $link;

    public function getAllData($tableName)
    {
        return $this->link
            ->query('SELECT * FROM ' . $tableName)
            ->fetch_all(MYSQLI_ASSOC);
    }

/*
    pubic function getById($tableName, $id)
    {
        return $this->link
            ->query('SELECT * FROM ' . $tableName . ' WHERE id = ' . (int)$id)
            ->fetch_assoc();
    }
*/
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->link = mysqli_connect(
            self::$config['host'],
            self::$config['user'],
            self::$config['pwd'],
            self::$config['db'],
            self::$config['port'],
        );

        if (false === $this->link) {
            die("can't connect to DB");
        }
    }
}