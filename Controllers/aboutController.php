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
        $visi = !empty($visiData) ? $visiData : 'Data Visi Kosong/Tidak Ditemukan (Cek ID 2)';
        
        // Pecah Misi jadi array
        $misi = [];
        if ($misiRaw && trim($misiRaw) !== '') {
            // Pecah text menjadi array berdasarkan baris baru (Enter)
            // PHP_EOL mendeteksi \n atau \r\n
            $misi = explode("\n", $misiRaw);
            
            // Bersihkan spasi berlebih di setiap butir
            $misi = array_map('trim', $misi);
            
            // Hapus baris kosong
            $misi = array_filter($misi);
        }

        // 3. Panggil View (Variabel $visi dan $misi akan otomatis terkirim ke sini)
        include_once __DIR__ . '/../Views/visiMisi.php';
    }
}
?>