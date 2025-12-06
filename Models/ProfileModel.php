<?php
require_once __DIR__ . '/../core/Database.php';

class ProfileModel extends Database{

    public function __construct() {
        parent::__construct();
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
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  
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

    public function getVisi() {
        $sql = "SELECT isi_konten 
                FROM profile 
                WHERE tipe_konten = 2";
        return $this->fetchOne($sql);
    }
    public function getMisi() {
        $sql = "SELECT isi_konten from profile WHERE tipe_konten = 2";
        return $this->fetchOne($sql);
    }

    public function getProfileData() {
        return [
            'title'            => 'Lab Software Engineering - Home',
            
            'about_lab'        => $this->getTentangLab(),
            'achievement'      => $this->getPrestasi(),             
            'roadmap'          => $this->getRoadmap(),
            'personil'         => $this->getPersonil(),
            'artikel'          => $this->getArtikel(3),
            'scopes'           => $this->getScopes(),

            'customCSS'        => @file_get_contents(BASE_PATH . '../Views/assets/css/home.css')
        ];
    }

    // --- BAGIAN ADMIN (TAMBAHAN BARU) ---

    // 1. Ambil Konten Berdasarkan ID (Untuk Visi, Misi, Tentang)
    public function getContentById($id) {
        $sql = "SELECT * FROM profile WHERE id_profile = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 2. Update Konten Text (Visi, Misi, Tentang)
    public function updateContent($id, $content) {
        $sql = "UPDATE profile SET isi_konten = :content, last_updated = NOW() WHERE id_profile = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['content' => $content, 'id' => $id]);
    }

    // 3. Ambil Semua Scope (Focus)
    public function getAllScopes() {
        $sql = "SELECT * FROM profile WHERE tipe_konten = 4 ORDER BY id_profile ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Tambah Scope Baru
    public function addScope($title, $description, $iconClass) {
        // Simpan Title dan Description sebagai JSON
        $content = json_encode(['title' => $title, 'description' => $description]);
        
        // Simpan Icon Class ke kolom image_url (karena kolom ini VARCHAR/TEXT)
        $sql = "INSERT INTO profile (tipe_konten, isi_konten, image_url, last_updated) 
                VALUES (4, :desc, :icon, NOW())"; 
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['desc' => $content, 'icon' => $iconClass]);
    }

    // 5. Update Scope
    public function updateScope($id, $title, $description, $iconClass) {
        $content = json_encode(['title' => $title, 'description' => $description]);
        
        $sql = "UPDATE profile SET isi_konten = :content, image_url = :icon, last_updated = NOW() WHERE id_profile = :id";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['content' => $content, 'icon' => $iconClass, 'id' => $id]);
    }

    // 6. Hapus Scope
    public function deleteScope($id) {
        $sql = "DELETE FROM profile WHERE id_profile = :id AND tipe_konten = 4";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Ambil data Scope untuk ditampilkan di Home
    public function getScopes() {
        $sql = "SELECT isi_konten, image_url FROM profile WHERE tipe_konten = 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil Visi (ID 2)
    public function getVisiData() {
        $sql = "SELECT isi_konten FROM profile WHERE id_profile = 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res ? $res['isi_konten'] : null;
    }

    // Ambil Misi (ID 6)
    public function getMisiData() {
        $sql = "SELECT isi_konten FROM profile WHERE id_profile = 6";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res ? $res['isi_konten'] : null;
    }
}
?>