<?php
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/AdminModel.php';

class authController{

    public function createDefaultAdmin(){
        $username = "admin";
        $password = "adminlabse";
        $email = "admin@lab.se.com";

        $adminModel = new AdminModel();
        $user = $adminModel->getUserByUsername($username);
        if ($user) {
            return false;
        }
        $adminModel->addUser($username, $password, $email);
    }

    public function indexLogin(){
        include_once __DIR__ . '/../Views/login.php';
    }

    public function login($username, $password){
        session_start();
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $adminModel = new AdminModel();
        $user = $adminModel->getUserByUsername($username);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['uadmin'] = $user['username'];
            header("Location: /admin/index.php?action=personil");
            exit;
        }
        header("Location: ../views/login.php?error=1");
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}
?>