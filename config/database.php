<?php

namespace config;

class Database {
    private $host = "localhost";
    private $user = "root"; // or "root" in local depending on connect.php
    private $password = ""; // or "" locally
    private $dbname = "kerala_congress";

    private $conn;

    public function __construct() {
        // Configuration is set via class properties above.
        // If specific per-environment overrides are needed, they can be added here.
        if($_SERVER['SERVER_NAME'] === 'localhost'){
            $this->user = "root";
            $this->password = "";
        }
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch(\PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
