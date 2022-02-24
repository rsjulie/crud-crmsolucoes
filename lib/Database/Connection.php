<?php
    class Connection {
        private $host;
        private $db_name;
        private $username;
        private $password;
        private $conn;

        public function getConn(){
            $this->conn = null;

            $this->host = getenv("DB_HOST") ? getenv("DB_HOST") : "localhost";
            $this->db_name = getenv("DB_NAME") ? getenv("DB_NAME") : "crud";
            $this->username = getenv("DB_USER") ? getenv("DB_USER") : "root";
            $this->password = getenv("DB_PASSWORD") ? getenv("DB_PASSWORD") : "";

            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";charset=utf8", $this->username, $this->password);
                $this->conn->exec("CREATE DATABASE IF NOT EXISTS " . $this->db_name . ";");
                $this->conn->exec("USE " . $this->db_name . ";");
            } catch(PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
                echo "\nHost: " . $this->host . "\n";
                echo "Database Name: " . $this->db_name . "\n";
                echo "User: " . $this->username . "\n";
                echo "Password " . $this->password . "\n";
                http_response_code(500);
                exit();
            }

            return $this->conn;
        }
    }