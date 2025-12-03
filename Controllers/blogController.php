<?php
require_once __DIR__ . '/../Models/ArtikelModel.php';

session_start();

class BlogController {
    private $model;

    public function __construct() {
        $this->model = new ArtikelModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'add') {
                $this->store();
            } elseif ($action === 'edit') {
                $this->update();
            } elseif ($action === 'delete') {
                $this->delete();
            }
        }
    }

    public function index() {
        // Cek apakah ada request pencarian dari URL (?search=...)
        $keyword = isset($_GET['search']) ? $_GET['search'] : null;
        
        // Kirim keyword ke model
        return $this->model->getAllArtikel($keyword);
    }

    // --- LOGIKA UPLOAD GAMBAR ---
    private function uploadImage() {
        if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
            return null; // Tidak ada gambar diupload
        }

        $targetDir = __DIR__ . "/../Views/assets/uploads/";
        
        // Buat folder jika belum ada
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . '_' . basename($_FILES["gambar"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $dbFilePath = "assets/uploads/" . $fileName; // Path untuk disimpan di DB

        // Cek tipe file (Opsional: validasi jpg/png)
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        if(!in_array($fileType, ['jpg', 'png', 'jpeg', 'gif'])){
            return null;
        }

        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
            return $dbFilePath;
        }
        return null;
    }

    private function store() {
        $data = $_POST;
        // Proses upload gambar
        $imageUrl = $this->uploadImage();
        
        // Jika upload berhasil, masukkan path ke data, jika gagal pakai default
        $data['image_url'] = $imageUrl ? $imageUrl : 'assets/bg.png'; 

        if ($this->model->addArtikel($data)) {
            $_SESSION['flash'] = "Artikel berhasil ditambahkan!";
        } else {
            $_SESSION['error'] = "Gagal menambahkan artikel.";
        }
        header("Location: ../Views/admin/blogArtikel.php");
        exit;
    }

    private function update() {
        $data = $_POST;
        
        // Cek apakah user upload gambar baru
        $imageUrl = $this->uploadImage();
        if ($imageUrl) {
            $data['image_url'] = $imageUrl; // Update dengan gambar baru
        } else {
            $data['image_url'] = $_POST['old_image']; // Pakai gambar lama
        }

        if ($this->model->updateArtikel($data)) {
            $_SESSION['flash'] = "Artikel berhasil diperbarui!";
        } else {
            $_SESSION['error'] = "Gagal memperbarui artikel.";
        }
        header("Location: ../Views/admin/blogArtikel.php");
        exit;
    }

    private function delete() {
        $id = $_POST['id_hapus'];
        if ($this->model->deleteArtikel($id)) {
            $_SESSION['flash'] = "Artikel berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus artikel.";
        }
        header("Location: ../Views/admin/blogArtikel.php");
        exit;
    }
}

// Handler Request
if (isset($_POST['action'])) {
    $controller = new BlogController();
    $controller->handleRequest();
}
?>