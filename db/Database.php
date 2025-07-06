<?php
class Database {
    private $host = 'localhost';
    private $dbName = 'pc-gateway';
    private $username = 'root';
    private $password = '';
    private $pdo;
    private static $instance;

    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("DB Error: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
