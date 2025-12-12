<?php
require_once __DIR__ . '/../Models/ArtikelModel.php';
require_once __DIR__ . '/../Models/KategoriModel.php';

class BlogController {
    private $model;
    private $kategoriModel;

    public function __construct() {
        $this->model = new ArtikelModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'addArtikel') {
                $this->store();
            } elseif ($action === 'editArtikel') {
                $this->update();
            } elseif ($action === 'deleteArtikel') {
                $this->delete();
            }
        }
    }

    // === HALAMAN PUBLIC (USER) - Limit 6 Data ===
    public function indexUser() {
        $filterKategori = $_GET['kategori'] ?? 'all';
        $searchKeyword  = $_GET['search'] ?? null;

        // 1. Ambil semua data (sesuai filter/search)
        if ($searchKeyword) {
            $allArtikel = $this->model->getAllArtikel($searchKeyword);
        } elseif ($filterKategori === 'all') {
            $allArtikel = $this->model->getAllArtikel();
        } else {
            $allArtikel = $this->model->getArtikelByKategori($filterKategori);
        }

        // 2. Konfigurasi Pagination (LIMIT 6)
        $items_per_page = 6; 
        $current_page = max(1, intval($_GET['page'] ?? 1));
        $total_items = count($allArtikel);
        $total_pages = max(1, ceil($total_items / $items_per_page));

        if ($current_page > $total_pages && $total_pages > 0) {
            $current_page = $total_pages;
        }

        // 3. Potong Array (Slicing)
        $offset = ($current_page - 1) * $items_per_page;
        $artikelList = array_slice($allArtikel, $offset, $items_per_page);

        // 4. Query string untuk link pagination
        $search_query = '';
        if($searchKeyword) $search_query .= '&search=' . urlencode($searchKeyword);
        if($filterKategori !== 'all') $search_query .= '&kategori=' . urlencode($filterKategori);

        $kategoriList = $this->getKategori();

        include __DIR__ . '/../Views/blog.php';
    }

    // === HALAMAN ADMIN - Limit 10 Data ===
    public function showAdminArtikel() {
        $userId = $_SESSION['user_id'] ?? null;
        $userRole = $_SESSION['role'] ?? null;

        $searchKeyword = $_GET['search'] ?? null;


        // 1. Ambil semua data
        if ($userRole === 'dosen') {
            // Filter artikel milik dosen
            $allArtikel = $this->model->getArtikelByUser($userId, $searchKeyword);
        } else {
            // Admin/role lain lihat semua artikel
            $allArtikel = $this->model->getAllArtikel($searchKeyword);
        }
        // 2. Konfigurasi Pagination (LIMIT 10)
        $items_per_page = 10; 
        $current_page = max(1, intval($_GET['page'] ?? 1));
        $total_items = count($allArtikel);
        $total_pages = max(1, ceil($total_items / $items_per_page));

        if ($current_page > $total_pages && $total_pages > 0) {
            $current_page = $total_pages;
        }

        // 3. Potong Array
        $offset = ($current_page - 1) * $items_per_page;
        $artikelList = array_slice($allArtikel, $offset, $items_per_page);
        
        // 4. Query string
        $search_query = $searchKeyword ? '&search=' . urlencode($searchKeyword) : '';

        $kategoriList = $this->getKategori(); 

        include __DIR__ . '/../Views/admin/blogartikel.php';
    }

    public function show($id_artikel) {
        $artikel = $this->model->getArtikelById($id_artikel);
        if (!$artikel) {
            header("Location: /index.php?action=blog");
            exit;
        }
        include __DIR__ . '/../Views/artikel.php';
    }

    public function index() {
        // Fungsi helper sederhana jika dibutuhkan oleh method lain
        $keyword = isset($_GET['search']) ? $_GET['search'] : null;
        return $this->model->getAllArtikel($keyword);
    }
    
    private function getKategori() {
        return $this->kategoriModel->getAll();
    }

    // --- LOGIKA UPLOAD GAMBAR ---
    private function uploadImage() {
        if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
            return null; 
        }

        $targetDir = __DIR__ . '/../Views/assets/uploads/';
        
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . '_' . basename($_FILES["gambar"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $dbFilePath = "/Views/assets/uploads/" . $fileName; 

        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        if(!in_array($fileType, ['jpg', 'png', 'jpeg', 'gif', 'webp'])){
            return null;
        }

        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
            return $dbFilePath;
        }
        return null;
    }

    private function store() {
        $data = $_POST;
        $data['user_id'] = $_SESSION['user_id'] ?? null; // pastikan tetap user yg sama
        $imageUrl = $this->uploadImage();
        $data['image_url'] = $imageUrl ? $imageUrl : 'assets/bg.png'; 

        if ($this->model->addArtikel($data)) {
            $_SESSION['flash'] = "Artikel berhasil ditambahkan!";
        } else {
            $_SESSION['error'] = "Gagal menambahkan artikel.";
        }
 
        header("Location: /admin/index.php?action=blog");
        exit;
    }

    private function update() {
        $data = $_POST;
        $data['user_id'] = $_SESSION['user_id'] ?? null; // pastikan tetap user yg sama
        $imageUrl = $this->uploadImage();
        if ($imageUrl) {
            $data['image_url'] = $imageUrl; 
        } else {
            $data['image_url'] = $_POST['old_image']; 
        }

        if ($this->model->updateArtikel($data)) {
            $_SESSION['flash'] = "Artikel berhasil diperbarui!";
        } else {
            $_SESSION['error'] = "Gagal memperbarui artikel.";
        }
        
        header("Location: /admin/index.php?action=blog");
        exit;
    }

    private function delete() {
        $id = $_POST['id_hapus'];
        if ($this->model->deleteArtikel($id)) {
            $_SESSION['flash'] = "Artikel berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus artikel.";
        }
        
        header("Location: /admin/index.php?action=blog");
        exit;
    }
}

if (isset($_POST['action'])) {
    $controller = new BlogController();
    $controller->handleRequest();
}
?>