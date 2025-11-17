<?php
require_once __DIR__ . "/../Core/Database.php";
require_once __DIR__ . "/../UserModel.php";

class InitAdmin {
    private $userModel;

    public function __construct(){;
        $this->userModel = new UserModel();
    }

    public function createDefaultAdmin() {
        $username = "admin";
        $password = "adminlabse";

        $user = $this->userModel->getUserByUsername($username);
        if ($user) {
            echo "Admin sudah ada, tidak dibuat ulang.\n";
            return false;
        }

        if ($this->userModel->addUser($username, $password)) {
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