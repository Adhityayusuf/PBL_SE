<?php

class ProfileModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    private function fetchAllData($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    private function fetchOne($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getTentangLab()
    {
        $sql = "SELECT isi_konten, image_url 
                FROM profile 
                WHERE tipe_konten = 1
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPrestasi()
    {
        $sql = "SELECT id_prestasi, prestasi, image_url 
                FROM prestasi 
                ORDER BY id_prestasi DESC";
        return $this->fetchAllData($sql);
    }

    public function getRoadmaps()
    {
        $sql = "SELECT  isi_konten
                FROM profile
                WHERE tipe_konten = 3
                ORDER BY id_profile ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPersonil()
    {
        $sql = "SELECT nama, jabatan, photo_url
                FROM personil
                ORDER BY nip ASC";
        return $this->fetchAllData($sql);
    }

    public function getArtikel($limit = 3)
    {
        $sql = "SELECT a.id_artikel, a.title, a.subtitle, a.penulis, a.tanggal_publikasi, k.nama AS nama_kategori
                FROM artikel a
                JOIN kategori k ON a.kategori_id = k.id_kategori
                ORDER BY a.tanggal_publikasi DESC
                LIMIT ?";

        return $this->fetchAllData($sql, [$limit]);
    }

    public function getVisi()
    {
        $sql = "SELECT isi_konten 
                FROM profile 
                WHERE tipe_konten = 2";
        return $this->fetchOne($sql);
    }
    public function getMisi()
    {
        $sql = "SELECT isi_konten from profile WHERE tipe_konten = 2";
        return $this->fetchOne($sql);
    }

    public function getContentById($id)
    {
        $sql = "SELECT * FROM profile WHERE id_profile = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateContent($id, $content)
    {
        $sql = "UPDATE profile SET isi_konten = :content, last_updated = NOW() WHERE id_profile = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['content' => $content, 'id' => $id]);
    }

    public function getAllScopes()
    {
        $sql = "SELECT * FROM profile WHERE tipe_konten = 4 ORDER BY id_profile ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRoadmaps()
    {
        $sql = "SELECT id_profile, isi_konten
            FROM profile
            WHERE tipe_konten = 3
            ORDER BY id_profile ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addScope($title, $description, $iconClass)
    {

        $content = json_encode(['title' => $title, 'description' => $description]);

        $sql = "INSERT INTO profile (tipe_konten, isi_konten, image_url, last_updated) 
                VALUES (4, :desc, :icon, NOW())";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['desc' => $content, 'icon' => $iconClass]);
    }

    public function updateScope($id, $title, $description, $iconClass)
    {
        $content = json_encode(['title' => $title, 'description' => $description]);

        $sql = "UPDATE profile SET isi_konten = :content, image_url = :icon, last_updated = NOW() WHERE id_profile = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['content' => $content, 'icon' => $iconClass, 'id' => $id]);
    }

    public function deleteScope($id)
    {
        $sql = "DELETE FROM profile WHERE id_profile = :id AND tipe_konten = 4";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function getScopes()
    {
        $sql = "SELECT isi_konten, image_url FROM profile WHERE tipe_konten = 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVisiData()
    {
        $sql = "SELECT isi_konten FROM profile WHERE id_profile = 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res ? $res['isi_konten'] : null;
    }

    public function getMisiData()
    {
        $sql = "SELECT isi_konten FROM profile WHERE id_profile = 6";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res ? $res['isi_konten'] : null;
    }

    public function addRoadmap($content)
    {
        $sql = "INSERT INTO profile (tipe_konten, isi_konten, last_updated)
            VALUES (3, :content, NOW())";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['content' => $content]);
    }

    public function deleteRoadmap($id)
    {
        $sql = "DELETE FROM profile WHERE id_profile = :id AND tipe_konten = 3";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function getAllPrestasi()
    {
        $sql = "SELECT id_prestasi, prestasi, image_url
            FROM prestasi
            ORDER BY id_prestasi ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPrestasi($judul, $link_gambar)
    {
        $stmt = $this->conn->prepare("INSERT INTO prestasi (prestasi, image_url) VALUES (:prestasi, :image_url)");
        $stmt->execute([
            ':prestasi' => $judul,
            ':image_url' => $link_gambar
        ]);
    }

    public function updatePrestasi($id, $judul, $link)
    {
        $sql = "UPDATE prestasi SET prestasi=:prestasi, image_url=:link WHERE id_prestasi=:id_prestasi";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':prestasi' => $judul,
            ':link' => $link,
            ':id_prestasi' => $id
        ]);
    }

    public function deletePrestasi($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM prestasi WHERE id_prestasi=:id");
        $stmt->execute([':id' => $id]);
    }

    public function getPrestasiById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM prestasi WHERE id_prestasi=:id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
