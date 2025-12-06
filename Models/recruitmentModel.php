<?php

class RecruitmentModel extends Database{
        public function addMahasiswa($nama, $nim, $prodi, $angkatan){
        $sql = "INSERT INTO mahasiswa (nama, nim, prodi_id, angkatan) VALUES ('$nama', '$nim', '$prodi', '$angkatan')";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->rowCount() > 0;
    }

    public function getMahasiswaByNim($nim){
        $sql = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllMahasiswa(){
        $sql = "SELECT m.nama, m.nim, p.nama AS prodi, m.angkatan, m.status FROM mahasiswa AS m 
            JOIN prodi AS p 
            ON m.prodi_id = p.id_prodi";

        // $sql = "SELECT * FROM mahasiswa";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getMahasiswaMenunggu(){
    //     $sql = "SELECT * FROM mahasiswa WHERE status = 'menunggu'";
    //     $result = $this->conn->prepare($sql);
    //     $result->execute();
    //     return $result->fetchAll(PDO::FETCH_ASSOC); 
    // }

    public function approveMahasiswa($id){
        $sql = "UPDATE mahasiswa SET status = 'setuju' WHERE id = $id";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->rowCount() > 0;
    }

    public function deleteMahasiswa($id) {
        $sql = "DELETE FROM mahasiswa WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    //     public function getMahssiswaSetujui(){
    //     $sql = "SELECT * FROM mahasiswa WHERE status = 'setuju'";
    //     $result = $this->conn->prepare($sql);
    //     $result->execute();
    //     return $result->fetchAll(PDO::FETCH_ASSOC);
    // }
}

?>