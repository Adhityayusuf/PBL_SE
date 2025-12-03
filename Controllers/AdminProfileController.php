<?php
require_once __DIR__ . '/../Models/ProfileModel.php';

class AdminProfileController {
    private $model;

    public function __construct() {
        $this->model = new ProfileModel();
    }

    public function handleRequest() {
        $action = $_POST['action'] ?? '';

        switch ($action) {
            case 'update_tentang':
                $id = 1; 
                $content = $_POST['isi_tentang'];
                $this->model->updateContent($id, $content);
                header("Location: ../Views/admin/profil.php?status=success");
                break;

            case 'update_visimisi':
                $id = $_POST['id_profile']; 
                $content = $_POST['isi_visimisi'];
                $this->model->updateContent($id, $content);
                header("Location: ../Views/admin/profil.php?status=success");
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
                header("Location: ../Views/admin/profil.php?status=success");
                break;

            case 'delete_scope':
                $id = $_POST['id_to_delete'];
                $this->model->deleteScope($id);
                header("Location: ../Views/admin/profil.php?status=deleted");
                break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AdminProfileController();
    $controller->handleRequest();
}
?>