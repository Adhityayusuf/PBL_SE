<?php
require_once __DIR__ . "/../Database.php";
require_once __DIR__ . "/../../Models/AdminModel.php";

class InitAdmin {
    private $adminModel;

    public function __construct(){;
        $this->adminModel = new AdminModel();
    }

    public function createDefaultAdmin() {
        $username = "admin";
        $password = "123";
        $email = "admin@lab.se.com";

        $user = $this->adminModel->getUserByUsername($username);
        if ($user) {
            echo "Admin sudah ada, tidak dibuat ulang.\n";
            return false;
        }

        if ($this->adminModel->addUser($username, $password, $email)) {
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