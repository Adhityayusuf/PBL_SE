<?php
require_once __DIR__ . '/../Models/ProfileModel.php';

class aboutController{
    private $profileModel;

    public function __construct(){
        $this->profileModel = new ProfileModel();
    }

    public function visiMisi(){
        // 1. Ambil data dari tabel 'profile' (ID 2 & 6)
        $visiData = $this->profileModel->getVisiData(); 
        $misiRaw = $this->profileModel->getMisiData();

        // 2. Masukkan ke variabel $visi & $misi (JANGAN GANTI NAMA INI)
        $visi = $visiData; 
        
        // Pecah Misi jadi array
        if ($misiRaw && trim($misiRaw) !== '') {
            $misi = array_filter(explode("\n", $misiRaw)); 
        } else {
            $misi = [];
        }

        // 3. Panggil View (Variabel $visi dan $misi akan otomatis terkirim ke sini)
        include_once __DIR__ . '/../Views/visiMisi.php';
    }
}
?>