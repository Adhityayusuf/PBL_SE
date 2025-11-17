<?php
class Database {
        private $host = 'pbl-db.c7k9dfm2qjsk.ap-southeast-1.rds.amazonaws.com';
        private $port = '61432';
        private $username = 'ardhan';
        private $password = 'ardhan';
        private $dbname = 'pbl';
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
