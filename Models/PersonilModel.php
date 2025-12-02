<?php

class PersonilModel extends Database {
    public function getAllPersonil() {
        $sql = "SELECT id_personil, nip, nama, email, jabatan, ruang_dosen, content_sosial, photo_url FROM personil ORDER BY id_personil ASC";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPersonilById($id_personil) {
        $sql = "SELECT id_personil, nip, jabatan, nama, email, ruang_dosen, content_sosial, photo_url FROM personil WHERE id_personil = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_personil);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPersonil($nip, $nama, $email, $jabatan, $ruang_dosen, $content_sosial = null, $photo_url = null) {
        $sql = "INSERT INTO personil (nip, nama, email, jabatan, ruang_dosen, content_sosial, photo_url) 
                VALUES (:nip, :nama, :email, :jabatan, :ruang_dosen, :content_sosial, :photo_url)";
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':nip', $nip);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':jabatan', $jabatan);
        $stmt->bindParam(':ruang_dosen', $ruang_dosen);
        $stmt->bindParam(':content_sosial', $content_sosial);
        $stmt->bindParam(':photo_url', $photo_url);
        
        return $stmt->execute();
    }

    public function updatePersonil($id_personil, $nip, $nama, $email, $jabatan, $ruang_dosen, $content_sosial = null, $photo_url = null) {
        $sql = "UPDATE personil SET nip = :nip, nama = :nama, email = :email, jabatan = :jabatan, 
                ruang_dosen = :ruang_dosen, content_sosial = :content_sosial, photo_url = :photo_url 
                WHERE id_personil = :id";
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':id', $id_personil);
        $stmt->bindParam(':nip', $nip);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':jabatan', $jabatan);
        $stmt->bindParam(':ruang_dosen', $ruang_dosen);
        $stmt->bindParam(':content_sosial', $content_sosial);
        $stmt->bindParam(':photo_url', $photo_url);
        
        return $stmt->execute();
    }

    public function deletePersonil($id_personil) {
        $sql = "DELETE FROM personil WHERE id_personil = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_personil);
        
        return $stmt->execute();
    }

}
?>
