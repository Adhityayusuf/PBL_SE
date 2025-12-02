<?php
require_once __DIR__ . '/../core/Database.php';

class ProfileModel {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    
    private function fetchAllData($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
    
    private function fetchOne($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function getTentangLab() {
        $sql = "SELECT isi_konten, image_url 
                FROM profile 
                WHERE tipe_konten = 1
                LIMIT 1";
        return $this->fetchOne($sql); 
    }

    public function getPrestasi() {
        $sql = "SELECT prestasi, image_url 
                FROM prestasi 
                ORDER BY id_prestasi DESC";
        return $this->fetchAllData($sql);
    }

    public function getRoadmap() {
        $sql = "SELECT isi_konten, last_updated
                FROM profile
                WHERE tipe_konten = 3
                ORDER BY last_updated ASC";
        return $this->fetchAllData($sql);
    }

    public function getPersonil() {
        $sql = "SELECT nama, jabatan, photo_url
                FROM personil
                ORDER BY nip ASC";
        return $this->fetchAllData($sql);
    }

    public function getArtikel($limit = 3) {
        $sql = "SELECT a.title, a.subtitle, a.penulis, a.tanggal_publikasi, k.nama AS nama_kategori
                FROM artikel a
                JOIN kategori k ON a.kategori_id = k.id_kategori
                ORDER BY a.tanggal_publikasi DESC
                LIMIT ?";
        
        return $this->fetchAllData($sql, [$limit]); 
    }


    // --- METHOD UTAMA ---
    public function getProfileData() {
        return [
            'title'            => 'Lab Software Engineering - Home',
            
            'about_lab'        => $this->getTentangLab(),
            'achievement'      => $this->getPrestasi(), 
            
            'roadmap'          => $this->getRoadmap(),
            'personil'         => $this->getPersonil(),
            'artikel'          => $this->getArtikel(3),

            // Path CSS sudah benar asalkan BASE_PATH benar
            'customCSS'        => @file_get_contents(BASE_PATH . '../Views/assets/css/home.css')
        ];
    }
}
?>