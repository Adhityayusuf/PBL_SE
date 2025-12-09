<?php
require_once __DIR__ . '/../Core/Database.php';

class GeekModel extends Database
{
    private $db;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT 
        m.id_mahasiswa,
        m.nama,
        m.nim,
        m.angkatan,
        m.minat,
        m.status,
        p.nama as prodi
    FROM mahasiswa m
    LEFT JOIN prodi p ON m.prodi_id = p.id_prodi
    ORDER BY 
        CASE 
            WHEN m.status = 'menunggu' THEN 0
            ELSE 1
        END,
        m.id_mahasiswa DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function approve($nim)
    {
        $stmt = $this->conn->prepare("UPDATE mahasiswa SET status = 'disetujui' WHERE nim = :nim");
        return $stmt->execute(['nim' => $nim]);
    }

    public function delete($nim)
    {
        $stmt = $this->conn->prepare("DELETE FROM mahasiswa WHERE nim = :nim");
        return $stmt->execute(['nim' => $nim]);
    }
    public function getPaged($start, $limit)
    {
        $stmt = $this->conn->prepare("
        SELECT m.id_mahasiswa, m.nama, m.nim, m.angkatan, m.minat, m.status, p.nama AS prodi
        FROM mahasiswa m
        LEFT JOIN prodi p ON m.prodi_id = p.id_prodi
        ORDER BY 
            CASE WHEN m.status = 'menunggu' THEN 0 ELSE 1 END,
            m.id_mahasiswa DESC
        LIMIT :limit OFFSET :start
    ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM mahasiswa");
        return $stmt->fetchColumn();
    }
}
