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
        $sql = "SELECT id_pengabdian, judul_pengabdian, sumber_dana, jml_dana, tahun, link 
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
        $sql = "SELECT id_artikel, judul, nama_jurnal, tahun, link 
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
        $sql = "SELECT id_buku, judul, penerbit, halaman, tahun, link 
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

    public function deletePengabdian($id_pengabdian)
    {
        $sql = "DELETE FROM personil_pengabdian WHERE id_pengabdian = :id_pengabdian";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_pengabdian', $id_pengabdian);
        
        return $stmt->execute();
    }

        // Pengabdian
    public function addPengabdian($data)
    {
        $sql = "INSERT INTO personil_pengabdian (judul_pengabdian, sumber_dana, jml_dana, tahun, link, personil_id) 
                VALUES (:judul_pengabdian, :sumber_dana, :jml_dana, :tahun, :link, :personil_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':judul_pengabdian', $data['judul_pengabdian']);
        $stmt->bindValue(':sumber_dana', $data['sumber_dana']);
        $stmt->bindValue(':jml_dana', $data['jml_dana']); 
        $stmt->bindValue(':tahun', $data['tahun']); 
        $stmt->bindValue(':link', $data['link']);
        $stmt->bindValue(':personil_id', $data['personil_id']);

        return $stmt->execute();
    }

        public function updatePengabdian($id_pengabdian, $data)
    {
        // Prepare the update query
        $sql = "UPDATE personil_pengabdian 
                SET judul_pengabdian = :judul_pengabdian, 
                    sumber_dana = :sumber_dana, 
                    jml_dana = :jml_dana, 
                    tahun = :tahun, 
                    link = :link 
                WHERE id_pengabdian = :id_pengabdian";

        $stmt = $this->conn->prepare($sql);

        // Bind the values to the query
        $stmt->bindValue(':judul_pengabdian', $data['judul_pengabdian']);
        $stmt->bindValue(':sumber_dana', $data['sumber_dana']);
        $stmt->bindValue(':jml_dana', $data['jml_dana']); 
        $stmt->bindValue(':tahun', $data['tahun']); 
        $stmt->bindValue(':link', $data['link']);
        $stmt->bindValue(':id_pengabdian', $id_pengabdian, PDO::PARAM_INT);

        return $stmt->execute();
    }

        // Artikel Ilmiah
    public function addArtikelIlmiah($data)
    {
        $sql = "INSERT INTO personil_artikel_ilmiah (judul, nama_jurnal, tahun, link, personil_id) 
                VALUES (:judul, :nama_jurnal, :tahun, :link, :personil_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':judul', $data['judul']);
        $stmt->bindValue(':nama_jurnal', $data['nama_jurnal']);
        $stmt->bindValue(':tahun', $data['tahun']); 
        $stmt->bindValue(':link', $data['link']);
        $stmt->bindValue(':personil_id', $data['personil_id']);

        return $stmt->execute();
    }

    public function updateArtikelIlmiah($id_artikel, $data)
    {
        // Prepare the update query
        $sql = "UPDATE personil_artikel_ilmiah 
                SET judul = :judul, 
                    nama_jurnal = :nama_jurnal, 
                    tahun = :tahun, 
                    link = :link 
                WHERE id_artikel = :id_artikel";

        $stmt = $this->conn->prepare($sql);

        // Bind the values to the query
        $stmt->bindValue(':judul', $data['judul']);
        $stmt->bindValue(':nama_jurnal', $data['nama_jurnal']);
        $stmt->bindValue(':tahun', $data['tahun']); 
        $stmt->bindValue(':link', $data['link']);
        $stmt->bindValue(':id_artikel', $id_artikel, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deleteArtikelIlmiah($id_artikel)
    {
        $sql = "DELETE FROM personil_artikel_ilmiah WHERE id_artikel = :id_artikel";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_artikel', $id_artikel);
        
        return $stmt->execute();
    }

    public function addKaryaBuku($data)
    {
        $sql = "INSERT INTO personil_karya_buku (judul, penerbit, halaman, tahun, link, personil_id) 
                VALUES (:judul, :penerbit, :halaman, :tahun, :link, :personil_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':judul', $data['judul_buku']);
        $stmt->bindValue(':penerbit', $data['penerbit']);
        $stmt->bindValue(':halaman', $data['halaman']);
        $stmt->bindValue(':tahun', $data['tahun']); 
        $stmt->bindValue(':link', $data['link']);
        $stmt->bindValue(':personil_id', $data['personil_id']);

        return $stmt->execute();
    }

    public function updateKaryaBuku($id_buku, $data)
    {
        // Prepare the update query
        $sql = "UPDATE personil_karya_buku 
                SET judul = :judul, 
                    penerbit = :penerbit,
                    halaman = :halaman,
                    tahun = :tahun, 
                    link = :link 
                WHERE id_buku = :id_buku";

        $stmt = $this->conn->prepare($sql);

        // Bind the values to the query
        $stmt->bindValue(':judul', $data['judul_buku']);
        $stmt->bindValue(':penerbit', $data['penerbit']);
        $stmt->bindValue(':halaman', $data['halaman']);
        $stmt->bindValue(':tahun', $data['tahun']); 
        $stmt->bindValue(':link', $data['link']);
        $stmt->bindValue(':id_buku', $id_buku, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deleteKaryaBuku($id_buku)
    {
        $sql = "DELETE FROM personil_karya_buku WHERE id_buku = :id_buku";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_buku', $id_buku);
        
        return $stmt->execute();
    }

    // HKI
    public function addHKI($data){
        $sql = "INSERT INTO personil_hki (judul, jenis, no_pdd, tahun, personil_id) 
                VALUES (:judul, :jenis, :no_pdd, :tahun, :personil_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':judul', $data['judul_hki']);
        $stmt->bindValue(':jenis', $data['jenis']);
        $stmt->bindValue(':no_pdd', $data['no_pdd']);
        $stmt->bindValue(':tahun', $data['tahun']); 
        $stmt->bindValue(':personil_id', $data['personil_id']);

        return $stmt->execute();
    }


    public function updateHKI($id_hki, $data)
    {
        // Prepare the update query
        $sql = "UPDATE personil_hki 
                SET judul = :judul, 
                    jenis = :jenis,
                    no_pdd = :no_pdd,
                    tahun = :tahun
                WHERE id_hki = :id_hki";

        $stmt = $this->conn->prepare($sql);

        // Bind the values to the query
        $stmt->bindValue(':judul', $data['judul_hki']);
        $stmt->bindValue(':jenis', $data['jenis']);
        $stmt->bindValue(':no_pdd', $data['no_pdd']);
        $stmt->bindValue(':tahun', $data['tahun']); 
        $stmt->bindValue(':id_hki', $id_hki, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function deleteHKI($id_hki)
    {
        $sql = "DELETE FROM personil_hki WHERE id_hki = :id_hki";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_hki', $id_hki);
        
        return $stmt->execute();
    }
    public function updateIdentitas($id, $data) {
    $sql = "UPDATE personil SET 
                nip = :nip, 
                nidn = :nidn, 
                nama = :nama,
                jenis_kelamin = :jenis_kelamin, 
                tempat_lahir = :tempat_lahir, 
                tgl_lahir = :tgl_lahir, 
                email = :email, 
                jabatan = :jabatan, 
                no_telp = :no_telp, 
                alamat_kantor = :alamat_kantor, 
                ruang_dosen = :ruang_dosen, 
                content_social = :content_social, 
                mata_kuliah = :mata_kuliah, 
                photo_url = :photo_url, 
                desc_diri = :desc_diri, 
                mhs_lulus = :mhs_lulus 
            WHERE id_personil = :id_personil";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(':nip', $data['nip']);
    $stmt->bindValue(':nidn', $data['nidn']);
    $stmt->bindValue(':nama', $data['nama']);
    $stmt->bindValue(':jenis_kelamin', $data['jenis_kelamin']);
    $stmt->bindValue(':tempat_lahir', $data['tempat_lahir']);
    $stmt->bindValue(':tgl_lahir', $data['tgl_lahir']);
    $stmt->bindValue(':email', $data['email']);
    $stmt->bindValue(':jabatan', $data['jabatan']);
    $stmt->bindValue(':no_telp', $data['no_telp']);
    $stmt->bindValue(':alamat_kantor', $data['alamat_kantor']);
    $stmt->bindValue(':ruang_dosen', $data['ruang_dosen']);
    $stmt->bindValue(':photo_url', $data['photo_url']);
    $stmt->bindValue(':desc_diri', $data['desc_diri']);
    $stmt->bindValue(':id_personil', $id);
    

    $stmt->bindValue(':content_social', is_array($data['content_social']) ? json_encode($data['content_social']) : $data['content_social']);
    $stmt->bindValue(':mata_kuliah', is_array($data['mata_kuliah']) ? json_encode($data['mata_kuliah']) : $data['mata_kuliah']);
    $stmt->bindValue(':mhs_lulus', is_array($data['mhs_lulus']) ? json_encode($data['mhs_lulus']) : $data['mhs_lulus']);

    return $stmt->execute();
}
}
