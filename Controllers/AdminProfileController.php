<?php
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/ProfileModel.php';

class AdminProfileController {
    private $model;

    public function __construct() {
        $this->model = new ProfileModel();
    }

    public function index() {
    // Ambil Data dari DB
    // Asumsi ID di database.sql: 1=Tentang, 2=Visi. 
    // Karena "Misi" belum ada di SQL dump Anda, Anda harus Insert manual 1 row tipe 2 lagi untuk Misi,
    // atau gunakan ID lain. Di sini saya asumsikan ID 2 = Visi, ID 3 = Misi.
        $tentang = $this->model->getContentById(1);
        $visi    = $this->model->getVisiData(); 
        $misi    = $this->model->getMisiData(); 

        // Jika data kosong (null), beri default agar tidak error
        $isiTentang = $tentang['isi_konten'] ?? 'Data belum tersedia.';
        $isiVisi    = $visi ?? 'Data belum tersedia.';
        $isiMisi    = $misi ?? 'Data belum tersedia.';
        $scopes = $this->model->getAllScopes();
        
        include '../Views/admin/profil.php';
    }

    public function handleRequest() {
        $action = $_POST['action'] ?? '';

        switch ($action) {
            case 'update_tentang':
                $id = 1; 
                $content = $_POST['isi_tentang'];
                $this->model->updateContent($id, $content);
                header("Location: /admin/index.php?action=profil&status=success");
                break;

            case 'update_visimisi':
                $id = $_POST['id_profile']; 
                $content = $_POST['isi_visimisi'];
                $this->model->updateContent($id, $content);
                header("Location: /admin/index.php?action=profil&status=success");
                break;

            case 'save_scope':
                $id = $_POST['scope_id'] ?? '';
                $name = $_POST['scope_name'];
                $desc = $_POST['scope_description'];
                // UBAHAN DISINI: Ambil text icon, bukan file
                $icon = $_POST['scope_icon']; 

                if (!empty($id)) {
                    // Update
                    $this->model->updateScope($id, $name, $desc, $icon);
                } else {
                    // Add New
                    // Default icon jika kosong
                    $icon = $icon ?: 'bi-code-slash'; 
                    $this->model->addScope($name, $desc, $icon);
                }
                header("Location: /admin/index.php?action=profil&status=success");
                break;

            case 'delete_scope':
                $id = $_POST['id_to_delete'];
                $this->model->deleteScope($id);
                header("Location: /admin/index.php?action=profil&status=success");
                break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AdminProfileController();
    $controller->handleRequest();
}
?>