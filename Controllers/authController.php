<?php
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/AdminModel.php';

class authController{

    // public function __construct(){
    //     $username = "admin";
    //     $password = "adminlabse";

    //     $userModel = new UserModel();
    //     $user = $userModel->getUserByUsername($username);
    //     if ($user) {
    //         return false;
    //     }
    //     $userModel->addUser($username, $password);
    // }


    public function login($username, $password){
        session_start();
        $adminModel = new AdminModel();
        $user = $adminModel->getUserByUsername($username);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['uadmin'] = $user['username'];
            return true;
        }
        return false;
    }
}


// Process login form submission dari login.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'login') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $authController = new authController();
    
    $user = $authController->login($username, $password);

    if ($user) {
        header("Location: ../views/admin/home.php");
        exit;
    } else {
        header("Location: ../views/login.php?error=1");
        exit;
    }
}

?>