<?php
class AdminModel extends Database {
    public function addUser($username, $password){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$hash')";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->rowCount() > 0;
    }
    public function getUserByUsername($username){
        $sql = "SELECT * FROM admins WHERE username = '$username'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

}
?>