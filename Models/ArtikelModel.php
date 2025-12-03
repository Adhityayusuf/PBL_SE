<?php
require_once __DIR__ . '/../Core/Database.php';

class ArtikelModel extends Database {
    
    public function __construct() {
        // GANTI $this->connect() MENJADI parent::__construct()
        // Ini akan menjalankan logika koneksi yang ada di Database.php
        parent::__construct();
    }

    // --- 1. READ (Ambil Data untuk Tampil di Blog & Admin) ---
    public function getAllArtikel($keyword = null) {
        $sql = "SELECT a.*, k.nama as nama_kategori 
                FROM artikel a 
                LEFT JOIN kategori k ON a.kategori_id = k.id_kategori";
        
        if ($keyword) {
            $sql .= " WHERE a.title ILIKE :keyword OR a.penulis ILIKE :keyword OR k.nama ILIKE :keyword";
        }

        // --- TAMBAHAN PENTING: Secondary Sort ---
        // Urutkan berdasarkan tanggal, lalu ID agar tidak lompat saat diedit
        $sql .= " ORDER BY a.tanggal_publikasi DESC, a.id_artikel DESC";
        
        $stmt = $this->conn->prepare($sql);

        if ($keyword) {
            $stmt->bindValue(':keyword', "%$keyword%");
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- Ambil Artikel berdasarkan Kategori ---
    public function getArtikelByKategori($kategoriId) {
        $sql = "SELECT a.*, k.nama as nama_kategori 
                FROM artikel a 
                JOIN kategori k ON a.kategori_id = k.id_kategori 
                WHERE a.kategori_id = :id
                ORDER BY a.tanggal_publikasi DESC, a.id_artikel DESC"; // Tambahkan sort ID
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $kategoriId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // --- 2. CREATE (Tambah Artikel Baru) ---
    public function addArtikel($data) {
        $sql = "INSERT INTO artikel (title, kategori_id, penulis, tanggal_publikasi, isi_konten, subtitle, image_url) 
                VALUES (:title, :kategori_id, :penulis, :tanggal_publikasi, :isi_konten, :subtitle, :image_url)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(':title', $data['judul']);
        $stmt->bindValue(':kategori_id', (int)$data['kategori']);
        $stmt->bindValue(':penulis', $data['author']);
        $stmt->bindValue(':tanggal_publikasi', $data['tanggal']);
        $stmt->bindValue(':isi_konten', $data['deskripsi']);
        $stmt->bindValue(':subtitle', $data['subtitle']); 
        $stmt->bindValue(':image_url', $data['image_url']);

        return $stmt->execute();
    }

    // --- 3. UPDATE (Edit Artikel) ---
    public function updateArtikel($data) {
        $sql = "UPDATE artikel SET 
                title = :title, 
                kategori_id = :kategori_id, 
                penulis = :penulis, 
                tanggal_publikasi = :tanggal_publikasi, 
                isi_konten = :isi_konten,
                subtitle = :subtitle,
                image_url = :image_url
                WHERE id_artikel = :id_artikel";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(':title', $data['judul']);
        $stmt->bindValue(':kategori_id', (int)$data['kategori']);
        $stmt->bindValue(':penulis', $data['author']);
        $stmt->bindValue(':tanggal_publikasi', $data['tanggal']);
        $stmt->bindValue(':isi_konten', $data['deskripsi']);
        $stmt->bindValue(':subtitle', $data['subtitle']);
        $stmt->bindValue(':image_url', $data['image_url']);
        $stmt->bindValue(':id_artikel', $data['id']);

        return $stmt->execute();
    }

    // --- 4. DELETE (Hapus Artikel) ---
    public function deleteArtikel($id) {
        $sql = "DELETE FROM artikel WHERE id_artikel = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // --- Ambil Detail Artikel ---
    public function getArtikelById($id) {
        $sql = "SELECT a.*, k.nama as nama_kategori 
                FROM artikel a 
                LEFT JOIN kategori k ON a.kategori_id = k.id_kategori 
                WHERE a.id_artikel = :id";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
}
?>