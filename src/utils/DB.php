<?php

namespace App\Utils;

use PDO;
use PDOException;

/**
 * Database Connection Singleton
 *
 * Manages the database connection using the Singleton pattern.
 */
class DB
{
    /**
     * @var PDO The PDO instance.
     */
    private $pdo;

    /**
     * @var DB The singleton instance.
     */
    private static $instance = null;

    /**
     * Private constructor to prevent multiple instances.
     *
     * Initializes the PDO connection.
     */
    private function __construct()
    {
        $dsn = 'mysql:dbname=phptest;host=127.0.0.1';
        $user = 'root';
        $password = '';

        try {
            $this->pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * Get the singleton instance of the DB class.
     *
     * @return DB The singleton instance.
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Executes a select query.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params Optional parameters for the query.
     * @return array The result set.
     */
    public function select($sql, array $params = [])
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Executes a non-select query (insert, update, delete).
     *
     * @param string $sql The SQL query to execute.
     * @param array $params Optional parameters for the query.
     * @return int The number of affected rows.
     */
    public function exec($sql, array $params = [])
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        return $sth->rowCount();
    }

    /**
     * Get the last inserted ID.
     *
     * @return string The last inserted ID.
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
