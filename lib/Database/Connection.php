<?php
    class Connection {
        private $host = "localhost";
        private $db_name = "project";
        private $username = "root";
        private $password = "";
        private $conn;

        public function getConn(){
            $this->conn = null;

            $db_url = getenv("CLEARDB_DATABASE_URL");
            if($db_url){
                $this->host = $db_url["host"];
                $this->username = $db_url["user"];
                $this->password = $db_url["pass"];
                $this->db_name = substr($db_url["path"],1);
            }

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