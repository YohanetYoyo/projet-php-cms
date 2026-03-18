<?php
class Database {
    private static $instance = null;
    private PDO $connection;

    private string $host = "db";
    private string $dbname = "app_cms";
    private string $username = "root";
    private string $password = "root";

    public function __construct()
    {
        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password);
    }

    public static function getInstance() : Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }

}