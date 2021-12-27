<?php

class DBConnect
{
    public const TABLE_GOODS = 'product';

    private static $config = [
        'dsn' => 'mysql:host=localhost;dbname=goods',
        'user' => 'root',
        'pwd' => '743752As',
    ];

    static $count = 0;
    private static $instance;
    private $link;

    public function getCount($tableName)
    {
        return $this->link
            ->query("SELECT COUNT(*) FROM {$tableName}")
            ->fetchColumn();//16:58
    }

    public function getAllData($tableName)
    {
        try {
            return $this->link
                ->query("SELECT * FROM {$tableName} LIMIT 0,5")
                ->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function getShowMore($tableName, int $start, int $limit)
    {

        try {
            return $this->link
                ->query("SELECT * FROM {$tableName} LIMIT {$start},{$limit}")
                ->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return false;
        }

    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->link = new PDO(
            self::$config['dsn'],
            self::$config['user'],
            self::$config['pwd']
        );

        if (false === $this->link) {
            die("can't connect to DB");
        }
    }

}