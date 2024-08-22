<?php

namespace App\Utils;

class DB
{
    private $pdo;

    private function __construct()
    {
        $dsn = 'mysql:dbname=phptest;host=127.0.0.1';
        $user = 'root';
        $password = '';

        $this->pdo = new \PDO($dsn, $user, $password);
    }

    public static function getInstance(): DB
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new self();
        }
        return $instance;
    }

    public function select(string $sql, array $params = []): array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function exec(string $sql, array $params = []): int
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }
}
