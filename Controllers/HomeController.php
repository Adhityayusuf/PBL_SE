<?php

require_once __DIR__ . '/../Models/ProfileModel.php';

class HomeController {

    public function index() {
        $model = new ProfileModel();
        $data = $model->getProfileData(); 
        return $data;
    }
}