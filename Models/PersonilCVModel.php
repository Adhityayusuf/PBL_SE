<?php

class PersonilCVModel extends Database
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getPersonilData($id_personil)
    {
        $sql = "SELECT id_personil, nip, nidn, nama, jenis_kelamin, tempat_lahir, tgl_lahir, email, jabatan, no_telp, alamat_kantor, ruang_dosen, content_social, mhs_lulus, mata_kuliah, photo_url, desc_diri 
                FROM personil 
                WHERE id_personil = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_personil, PDO::PARAM_INT);
        $stmt->execute();

        // Ambil hasil dan decode field JSON (PostgreSQL mengembalikan JSON sebagai string)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $result['content_sosial'] = json_decode($result['content_sosial'] ?? '[]', true);
            $result['mhs_lulus'] = json_decode($result['mhs_lulus'] ?? '[]', true);
            $result['mata_kuliah'] = json_decode($result['mata_kuliah'] ?? '[]', true);
        }

        // Untuk view tes.php (statistik) kita perlu hitungan dari tabel lain
        $stats = [
            'publikasi' => $this->countTableRows('personil_artikel_ilmiah', $id_personil),
            'karya_buku' => $this->countTableRows('personil_karya_buku', $id_personil),
            'hki' => $this->countTableRows('personil_hki', $id_personil),
            'penelitian' => $this->countTableRows('personil_penelitian', $id_personil),
            'pengabdian' => $this->countTableRows('personil_pengabdian', $id_personil),
        ];

        return ['identitas' => $result, 'stats' => $stats];
    }

    private function countTableRows($tableName, $personil_id)
    {
        $sql = "SELECT COUNT(*) FROM $tableName WHERE personil_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $personil_id, PDO::PARAM_INT);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * Mengambil riwayat pendidikan dari tabel personil_riwayat_pendidikan.
     * @param int $personil_id
     * @return array
     */
    public function getRiwayatPendidikan($personil_id)
    {
        $sql = "SELECT sarjana, magister, doktor 
            FROM personil_riwayat_pendidikan 
            WHERE personil_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $personil_id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Pastikan selalu array
        $sarjana  = json_decode($row['sarjana'] ?? '[]', true);
        $magister = json_decode($row['magister'] ?? '[]', true);
        $doktor   = json_decode($row['doktor'] ?? '[]', true);

        if (!is_array($sarjana)) $sarjana = [];
        if (!is_array($magister)) $magister = [];
        if (!is_array($doktor)) $doktor = [];

        return [
            'sarjana'  => $sarjana,
            'magister' => $magister,
            'doktor'   => $doktor
        ];
    }


    /**
     * Mengambil daftar penelitian dari tabel personil_penelitian.
     * @param int $personil_id
     * @return array
     */
    public function getPenelitian($personil_id)
    {
        $sql = "SELECT judul_penelitian, sumber_dana, jml_dana, tahun, link 
                FROM personil_penelitian 
                WHERE personil_id = :id 
                ORDER BY tahun DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $personil_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mengambil daftar pengabdian dari tabel personil_pengabdian.
     * @param int $personil_id
     * @return array
     */
    public function getPengabdian($personil_id)
    {
        $sql = "SELECT judul_pengabdian, sumber_dana, jml_dana, tahun, link 
                FROM personil_pengabdian 
                WHERE personil_id = :id 
                ORDER BY tahun DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $personil_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mengambil daftar artikel ilmiah dari tabel personil_artikel_ilmiah.
     * @param int $personil_id
     * @return array
     */
    public function getArtikelIlmiah($personil_id)
    {
        $sql = "SELECT judul, nama_jurnal, tahun, link 
                FROM personil_artikel_ilmiah 
                WHERE personil_id = :id 
                ORDER BY tahun DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $personil_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mengambil daftar karya buku dari tabel personil_karya_buku.
     * @param int $personil_id
     * @return array
     */
    public function getKaryaBuku($personil_id)
    {
        $sql = "SELECT judul, penerbit, halaman, tahun, link 
                FROM personil_karya_buku 
                WHERE personil_id = :id 
                ORDER BY tahun DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $personil_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mengambil daftar HKI dari tabel personil_hki.
     * @param int $personil_id
     * @return array
     */
    public function getHKI($personil_id)
    {
        $sql = "SELECT judul, jenis, no_pdd, tahun 
                FROM personil_hki 
                WHERE personil_id = :id 
                ORDER BY tahun DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $personil_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Metode utama untuk mengambil SEMUA data CV Personil.
     */
    public function getAllCVData($id_personil = 1)
    {
        $personilData = $this->getPersonilData($id_personil);

        return [
            'personil' => $personilData['identitas'],
            'stats' => $personilData['stats'],
            'pendidikan' => $this->getRiwayatPendidikan($id_personil),
            'penelitian' => $this->getPenelitian($id_personil),
            'pengabdian' => $this->getPengabdian($id_personil),
            'artikel' => $this->getArtikelIlmiah($id_personil),
            'buku' => $this->getKaryaBuku($id_personil),
            'hki' => $this->getHKI($id_personil),
        ];
    }
}
