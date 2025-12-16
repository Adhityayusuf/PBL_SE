<?php
class UserModel extends Database {
    public function __construct() {
        parent::__construct(); 
    }


    public function addUserA($user_id, $username, $email, $password = 'default_pass', $role = 'dosen', $photo_url = null) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (id_user, username, email, password, role, photo_url) 
                VALUES (:user_id, :username, :email, :password, :role, :photo_url)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':user_id' => $user_id,
            ':password' => $hash,
            ':role' => $role,
            ':photo_url' => $photo_url
        ]);
    }

    public function addUser($username, $email, $password = 'default_pass', $role = 'dosen', $photo_url = null) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password, role, photo_url) 
                VALUES (:username, :email, :password, :role, :photo_url)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hash,
            ':role' => $role,
            ':photo_url' => $photo_url
        ]);
    }

    // Update user
    public function updateUserByEmail($oldEmail, $username, $email, $photo_url = null) {
        $sql = "UPDATE users SET username = :username, email = :email, photo_url = :photo_url WHERE email = :oldEmail";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':photo_url' => $photo_url,
            ':oldEmail' => $oldEmail
        ]);
    }

    // Hapus Usrs
    public function deleteUserByEmail($email) {
        $sql = "DELETE FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':email' => $email]);
    }


    // Untuk cek Login
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function changePassword($email, $newPassword) {
        // Hash password baru
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':password' => $hash,
            ':email' => $email
        ]);
    }
}
?>