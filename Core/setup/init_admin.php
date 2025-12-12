<?php
require_once __DIR__ . "/../Database.php";
require_once __DIR__ . "/../../Models/UserModel.php";

class InitAdmin {
    private $userModel;

    public function __construct(){;
        $this->userModel = new UserModel();
    }

    public function createDefaultAdmin() {
        $username = "admin";
        $password = "123";
        $email = "admin@lab.se.com";
        $role = "admin";
        $photo_url = null;

        $user = $this->userModel->getUserByEmail($email);
        if ($user) {
            echo "Admin sudah ada, tidak dibuat ulang.\n";
            return false;
        }

        if ($this->userModel->addUser($username, $email, $password, $role, $photo_url)) {
            echo "Admin default berhasil dibuat.\n";
            return true;
        } else {
            echo "Gagal membuat admin default.\n";
            return false;
        }
    }
}

$init = new InitAdmin();
$init->createDefaultAdmin();
?>