<?php

namespace Scandioop\Includes;

use PDO;
use \PDOException;

class DatabaseConnection {
 private $pdo;

    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname=scandi_app';
        $username = 'root';
        $password = '';

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            // Set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }
    public function getConnection() {
        return $this->pdo;
    }
        public function query($sql)
    {
        return $this->pdo->query($sql);
    }
}
?>