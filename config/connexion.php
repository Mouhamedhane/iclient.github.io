<?php
class Database {
    private $host = ' mysql-mouha.alwaysdata.net';
    private $db_name = 'mouha_client';
    private $username = 'mouha_client';
    private $password = 'P@sser1234';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
