<?php
class Database {
    private static $instance = null;
    private $connection;

    // Private constructor to prevent multiple instances
    private function __construct() {
        $this->connection = new mysqli('localhost', 'root', '', 'expensetracker');

        if ($this->connection->connect_error) {
            die('Connection failed: ' . $this->connection->connect_error);
        }
    }

    // Get the single instance of the database
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}
?>
