<?php
class AdminModel extends Database {
    public function addUser($username, $password){
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admins (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hash);

        return $stmt->execute();
    }
    public function getUserByUsername($username){
        $sql = "SELECT * FROM admins WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>