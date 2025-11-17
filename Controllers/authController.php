<?php
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
        $adminModel = new AdminModel();
        $user = $adminModel->getUserByUsername($username);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

}

?>