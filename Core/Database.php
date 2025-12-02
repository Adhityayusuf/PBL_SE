<?php
class Database {
        private $host = 'localhost';
        private $port = '5432';
        private $username = 'postgres';
        private $password = '123';
        private $dbname = 'lab_se';
        protected $conn;

    public function __construct(){
        try {
            $destination = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";
            $this->conn = new PDO($destination, $this->username, $this->password);
        } catch (PDOException $e) {
            die('Koneksi Gagal: ' . $e->getMessage());
        }
    }

    public function getConnection(){
        return $this->conn;
    }
}
?>
