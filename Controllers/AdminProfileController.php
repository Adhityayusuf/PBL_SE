<?php
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/ProfileModel.php';

class AdminProfileController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProfileModel();
    }

    public function index()
    {
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
        $roadmaps = $this->model->getAllRoadmaps();
        $prestasi = $this->model->getAllPrestasi();

        include '../Views/admin/profil.php';
    }

    public function handleRequest()
    {
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
                $icon = $_POST['scope_icon'];

                if (!empty($id)) {
                    // Update
                    $this->model->updateScope($id, $name, $icon);
                } else {
                    // Add New
                    // Default icon jika kosong
                    $icon = $icon ?: 'bi-code-slash';
                    $this->model->addScope($name, $icon);
                }
                header("Location: /admin/index.php?action=profil&status=success");
                break;

            case 'delete_scope':
                $id = $_POST['id_to_delete'];
                $this->model->deleteScope($id);
                header("Location: /admin/index.php?action=profil&status=success");
                break;

            // AdminProfileController.php (di dalam handleRequest)

            case 'save_roadmap':
                $id = $_POST['id_profile'] ?? null;
                $title = trim($_POST['roadmap_title'] ?? '');
                $description = trim($_POST['roadmap_description'] ?? '');

                if ($title === '' || $description === '') {
                    header("Location: /admin/index.php?action=profil&status=error_empty");
                    break;
                }

                // JSON yang disimpan ke DB
                $content = json_encode([
                    'title' => $title,
                    'description' => $description
                ], JSON_UNESCAPED_UNICODE);

                if (!empty($id)) {
                    $this->model->updateContent($id, $content);
                } else {
                    $this->model->addRoadmap($content);
                }

                header("Location: /admin/index.php?action=profil&status=success");
                break;


            case 'delete_roadmap':
                $id = $_POST['id_to_delete'];
                $this->model->deleteRoadmap($id);
                header("Location: /admin/index.php?action=profil&status=success");
                break;

            case 'update_prestasi':
                $id = $_POST['id_prestasi'] ?? '';
                $judul = $_POST['prestasi'] ?? '';

                // Tangani file upload
                $link = ''; // default
                if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../Views/assets/uploads/prestasi/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $fileTmp  = $_FILES['image_url']['tmp_name'];
                    $fileName = basename($_FILES['image_url']['name']);
                    $fileExt  = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newName  = uniqid('prestasi_') . '.' . $fileExt;
                    $destination = $uploadDir . $newName;

                    if (move_uploaded_file($fileTmp, $destination)) {
                        $link = $newName; // path relatif untuk akses di web
                    }
                } else {
                    // Jika edit tapi tidak upload file baru, ambil link lama dari DB
                    if (!empty($id)) {
                        $oldPrestasi = $this->model->getPrestasiById($id);
                        $link = $oldPrestasi['link_gambar'] ?? '';
                    }
                }

                if (!empty($id)) {
                    $this->model->updatePrestasi($id, $judul, $link);
                } else {
                    $this->model->addPrestasi($judul, $link);
                }

                header("Location: /admin/index.php?action=profil&status=success");
                exit;
                break;


            case 'delete_prestasi':
                $id = $_POST['id_to_delete'];
                $this->model->deletePrestasi($id);
                header("Location: /admin/index.php?action=profil&status=success");
                exit;
                break;
        }
    }

    public function settings() {
        $username  = $_SESSION['username'] ?? '';
        $email     = $_SESSION['email'] ?? '';
        $role      = $_SESSION['role'] ?? '';
        $photo_url = $_SESSION['photo_url'] ?? '';

        include __DIR__ . '/../Views/admin/settings.php';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AdminProfileController();
}
