<?php
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/ProfileModel.php';

class AboutController{
    private $profileModel;

    public function __construct(){
        $this->profileModel = new ProfileModel();
    }

    public function visiMisi(){
        $visi = $this->profileModel->getVisiData();
        $misiDisplay = $this->profileModel->getMisiData();

        if(strpos($misiDisplay, '\n') !== false){
            $misi = nl2br(str_replace('\n', "\n", $misiDisplay));
        } else {
            $misi = $misiDisplay;
        }
        include_once __DIR__ . '/../Views/visiMisi.php';
    }
}

?>