<?php

require_once __DIR__ . '/../Core/Database.php';

class KategoriModel extends Database {

    public function __construct() {
        // GANTI $this->connect() MENJADI parent::__construct()
        parent::__construct(); 
    }

    public function getAll() {
        // Pastikan $this->conn sudah terbentuk dari parent::__construct()
        $query = $this->conn->query("SELECT * FROM kategori ORDER BY nama ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>