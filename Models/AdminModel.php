<?php
class AdminModel extends Database {
    public function addUser($username, $password, $email){
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admin (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    public function getUserByUsername($username){
        $sql = "SELECT * FROM admin WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>