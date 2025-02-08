<?php

namespace App\Database;

use PDO;

class Database
{
    /** @var Database */
    private static $instance;

    private PDO $connection;

    private function __construct()
    {
        $dbHost = $_ENV['DB_HOST'] ?? null;
        $dbPort = $_ENV['DB_PORT'] ?? null;
        $dbName = $_ENV['DB_NAME'] ?? null;
        $dbUser = $_ENV['DB_USER'] ?? null;
        $dbPass = $_ENV['DB_PASS'] ?? null;

        if (!$dbHost || !$dbPort || !$dbName || !$dbUser || !$dbPass) {
            throw new \PDOException('Database configuration environment variables are missing.');
        }

        $dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName";

        try {
            $this->connection = new PDO($dsn, $dbUser, $dbPass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \PDOException('Database connection failed: ' . $e->getMessage());
        }
    }


    public static function getInstance(): Database
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

}