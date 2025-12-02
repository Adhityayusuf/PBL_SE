<?php
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/AboutModel.php';

class AboutController{
    private $aboutModel;

    public function __construct(){
        $this->aboutModel = new AboutModel();
    }

    public function visiMisi(){
        $visi = $this->aboutModel->getVisi();
        $misi = $this->aboutModel->getMisi();
        include_once __DIR__ . '/../Views/visiMisi.php';
    }

    private function getVisi(){
        return $this->aboutModel->getVisi();
    }

    private function getMisi(){
        return $this->aboutModel->getMisi();
    }

    public function getTentang(){
        return $this->aboutModel->getTentang();
    }

    public function updateVisi($visi){
        $this->aboutModel->updateVisi($visi);
    }
    public function updateMisi($misi){
        $this->aboutModel->updateMisi($misi);
    }
}

?>