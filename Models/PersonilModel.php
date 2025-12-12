<?php
include_once __DIR__ . '/UserModel.php';

class PersonilModel extends Database {
    private $userModel;
    
    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel($this->conn);
    }

    public function getAllPersonil() {
        $sql = "SELECT id_personil, nip, nama, email, jabatan, ruang_dosen, content_social, photo_url FROM personil ORDER BY id_personil ASC";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPersonilById($id_personil) {
        $sql = "SELECT id_personil, nip, jabatan, nama, email, ruang_dosen, content_social, photo_url FROM personil WHERE id_personil = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_personil);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPersonil($nip, $nama, $email, $jabatan, $ruang_dosen, $content_social = null, $photo_url = null) {
        try {
            $this->conn->beginTransaction();
            
            $sql = "INSERT INTO personil (nip, nama, email, jabatan, ruang_dosen, content_social, photo_url) 
                    VALUES (:nip, :nama, :email, :jabatan, :ruang_dosen, :content_social, :photo_url)";
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':nip', $nip);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':jabatan', $jabatan);
            $stmt->bindParam(':ruang_dosen', $ruang_dosen);
            $stmt->bindParam(':content_social', $content_social);
            $stmt->bindParam(':photo_url', $photo_url);
            $stmt->execute();

            $this->userModel->addUser($nama, $email, 'default_pass', 'dosen', $photo_url);

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }

    }

    public function updatePersonil($id_personil, $nip, $nama, $email, $jabatan, $ruang_dosen, $content_social = null, $photo_url = null) {
        try {
            $this->conn->beginTransaction();

            $oldEmail = $this->getPersonilById($id_personil)['email'];

            $sql = "UPDATE personil SET nip = :nip, nama = :nama, email = :email, jabatan = :jabatan, 
            ruang_dosen = :ruang_dosen, content_social = :content_social, photo_url = :photo_url 
            WHERE id_personil = :id";
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':id', $id_personil);
            $stmt->bindParam(':nip', $nip);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':jabatan', $jabatan);
            $stmt->bindParam(':ruang_dosen', $ruang_dosen);
            $stmt->bindParam(':content_social', $content_social);
            $stmt->bindParam(':photo_url', $photo_url);
            $stmt->execute();
            
            if ($oldEmail) {
                $this->userModel->updateUserByEmail($oldEmail, $nama, $email, $photo_url);
            }
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function deletePersonil($id_personil) {
        try {
            $this->conn->beginTransaction();

            $personil = $this->getPersonilById($id_personil);
            $email = $personil['email'];
            
            $sql = "DELETE FROM personil WHERE id_personil = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id_personil);
            $stmt->execute();

            if($email) {
                $this->userModel->deleteUserByEmail($email);
            }
            
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
        
    }

    public function getPersonilByEmail($email) {
        $sql = "SELECT id_personil, nip, jabatan, nama, email, ruang_dosen, content_social, photo_url FROM personil WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
