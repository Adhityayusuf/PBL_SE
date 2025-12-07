<?php

require_once __DIR__ . '/../Models/ProfileModel.php';

class HomeController {
    private $profileModel;

    public function __construct() {
        $this->profileModel = new ProfileModel();
    }

    public function index() {
        $data = $this->profileModel->getProfileData();

        if (!isset($data['scopes'])) {
            $data['scopes'] = $this->profileModel->getScopes(); 
        }

        include_once __DIR__ . '/../Views/home.php';
    }
}