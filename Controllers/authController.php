<?php
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/UserModel.php';

class authController{
    public function indexLogin(){
        include_once __DIR__ . '/../Views/login.php';
    }

    public function login(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];
            if ($_SESSION['role'] === 'admin') {
                header("Location: /admin/index.php?action=personil");
                exit;
            } else {
                header("Location: /admin/index.php?action=dashboard_personil");
                exit;
            }
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