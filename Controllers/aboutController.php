<?php
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/ProfileModel.php';

class AboutController{
    private $profileModel;

    public function __construct(){
        $this->profileModel = new ProfileModel();
    }

    public function visiMisi(){
        $visi = $this->profileModel->getVisi();
        $misiDisplay = $this->profileModel->getMisi();

        $misi = nl2br(htmlspecialchars(str_replace("\n", "\n", $misiDisplay)));

        include_once __DIR__ . '/../Views/visiMisi.php';
    }
}

?>