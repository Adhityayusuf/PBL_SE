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
        $sql = "SELECT id_penelitian, judul_penelitian, sumber_dana, jml_dana, tahun, link 
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
        $sql = "SELECT id_hki ,judul, jenis, no_pdd, tahun 
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

    // public function updatePersonil($id_personil, $data)
    // {
    //     // Encode JSON fields
    //     if (isset($data['content_social'])) {
    //         $data['content_social'] = json_encode($data['content_social'], JSON_UNESCAPED_UNICODE);
    //     }
    //     if (isset($data['mata_kuliah'])) {
    //         if (is_string($data['mata_kuliah'])) {
    //             // jika textarea di-submit sebagai string
    //             $data['mata_kuliah'] = json_encode(array_map('trim', explode(',', $data['mata_kuliah'])), JSON_UNESCAPED_UNICODE);
    //         } else {
    //             $data['mata_kuliah'] = json_encode($data['mata_kuliah'], JSON_UNESCAPED_UNICODE);
    //         }
    //     }
    //     if (isset($data['mhs_lulus'])) {
    //         $data['mhs_lulus'] = json_encode($data['mhs_lulus'], JSON_UNESCAPED_UNICODE);
    //     }

    //     // Bangun query dinamis
    //     $fields = array_keys($data);
    //     $setStr = implode(", ", array_map(fn($f) => "$f = :$f", $fields));

    //     $sql = "UPDATE personil SET $setStr WHERE id_personil = :id";
    //     $stmt = $this->conn->prepare($sql);

    //     foreach ($data as $key => $value) {
    //         $stmt->bindValue(":$key", $value);
    //     }
    //     $stmt->bindValue(':id', $id_personil, PDO::PARAM_INT);

    //     return $stmt->execute();
    // }

    // public function deletePersonil($id_personil)
    // {
    //     // Hapus file photo jika ada
    //     $person = $this->getPersonilData($id_personil);
    //     if ($person && !empty($person['photo_url'])) {
    //         $filePath = __DIR__ . '/../../' . ltrim($person['photo_url'], '/');
    //         if (file_exists($filePath)) unlink($filePath);
    //     }

    //     // Hapus record
    //     $sql = "DELETE FROM personil WHERE id_personil = :id";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':id', $id_personil, PDO::PARAM_INT);
    //     return $stmt->execute();
    // }

    // PersonilCVModel.php
public function addPenelitian($data)
{

    $sql = "INSERT INTO personil_penelitian (judul_penelitian, sumber_dana, jml_dana, tahun, link, personil_id) 
            VALUES (:judul_penelitian, :sumber_dana, :jml_dana, :tahun, :link, :personil_id)";
    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(':judul_penelitian', $data['judul_penelitian']);
    $stmt->bindValue(':sumber_dana', $data['sumber_dana']);
    $stmt->bindValue(':jml_dana', $data['jml_dana']);
    $stmt->bindValue(':tahun', $data['tahun']);
    $stmt->bindValue(':link', $data['link']);
    $stmt->bindValue(':personil_id', $data['personil_id']);

    return $stmt->execute();
}

// Update Penelitian
public function updatePenelitian($id_penelitian, $data)
{
    // Prepare the update query
    $sql = "UPDATE personil_penelitian 
            SET judul_penelitian = :judul_penelitian, 
                sumber_dana = :sumber_dana, 
                jml_dana = :jml_dana, 
                tahun = :tahun, 
                link = :link 
            WHERE id_penelitian = :id_penelitian";

    $stmt = $this->conn->prepare($sql);

    // Bind the values to the query
    $stmt->bindValue(':judul_penelitian', $data['judul_penelitian']);
    $stmt->bindValue(':sumber_dana', $data['sumber_dana']);
    $stmt->bindValue(':jml_dana', $data['jml_dana']); 
    $stmt->bindValue(':tahun', $data['tahun']); 
    $stmt->bindValue(':link', $data['link']);
    $stmt->bindValue(':id_penelitian', $id_penelitian, PDO::PARAM_INT);

    return $stmt->execute();
}


// Delete Penelitian
    public function deletePenelitian($id_penelitian)
    {
        $sql = "DELETE FROM personil_penelitian WHERE id_penelitian = :id_penelitian";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_penelitian', $id_penelitian);
        
        return $stmt->execute();
    }




// public function updateHki($id_hki, $data) {
//     // Contoh query untuk update
//     $query = "UPDATE hki SET judul = ?, jenis = ?, no_pdd = ?, tahun = ?, link = ? WHERE id_hki = ?";
//     $stmt = $this->db->prepare($query);
//     $stmt->execute([$data['judul_hki'], $data['jenis_hki'], $data['no_pdd_hki'], $data['tahun_hki'], $data['link_hki'], $id_hki]);
// }

// public function addHki($data) {
//     // Contoh query untuk tambah
//     $query = "INSERT INTO hki (judul, jenis, no_pdd, tahun, link) VALUES (?, ?, ?, ?, ?)";
//     $stmt = $this->db->prepare($query);
//     $stmt->execute([$data['judul_hki'], $data['jenis_hki'], $data['no_pdd_hki'], $data['tahun_hki'], $data['link_hki']]);
// }

//     public function deleteHki($id_hki) {
//         $sql = "DELETE FROM personil_hki WHERE id_hki = :id_hki";
//         $stmt = $this->conn->prepare($sql);
//         $stmt->bindValue(':id_hki', $id_hki);
//         return $stmt->execute();
//     }
}
