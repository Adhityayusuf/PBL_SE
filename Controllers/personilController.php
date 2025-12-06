<?php

require_once __DIR__ . "/../Core/Database.php";
require_once __DIR__ . "/../Models/PersonilModel.php";

class PersonilController {
    private $model;
    private $upload_dir;
    public function __construct(){
        $this->model = new PersonilModel();
        $this->upload_dir = __DIR__ . '/../Views/assets/personil/';

        if (!is_dir($this->upload_dir)) {
            mkdir($this->upload_dir, 0755, true);
        }
    }

    public function index(){
        $personilModel = new PersonilModel();
        $all_personil = $personilModel->getAllPersonil();

        $search = trim($_GET['search'] ?? '');
        if ($search !== '') {
            $all_personil = array_values(array_filter($all_personil, function ($p) use ($search) {
                return stripos($p['nama'] ?? '', $search) !== false;
            }));
        }

        $search_query = $search !== '' ? '&search=' . urlencode($search) : '';

        $items_per_page = 6;
        $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

        $total_items = count($all_personil);
        $total_pages = ceil($total_items / $items_per_page);

        if ($current_page > $total_pages && $total_pages > 0) {
            $current_page = $total_pages;
        }

        $offset = ($current_page - 1) * $items_per_page;
        $dosenList = array_slice($all_personil, $offset, $items_per_page);
        include __DIR__ . "/../Views/personil.php";
    }

    private function handlePhotoUpload() {
        if (!isset($_FILES['photo']) || $_FILES['photo']['error'] === UPLOAD_ERR_NO_FILE) {
            return null; // Tidak ada file
        }

        if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error upload file: ' . $_FILES['photo']['error']);
        }

        $file = $_FILES['photo'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $file_type = mime_content_type($file['tmp_name']);
        
        if (!in_array($file_type, $allowed_types)) {
            throw new Exception('Tipe file tidak diizinkan. Gunakan JPG, PNG, GIF, atau WEBP');
        }

        if ($file['size'] > 2 * 1024 * 1024) {
            throw new Exception('Ukuran file terlalu besar (maksimal 2MB)');
        }

        // Generate nama file unik
        $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_filename = 'personil_' . time() . '_' . uniqid() . '.' . $file_ext;
        $file_path = $upload_dir . $new_filename;

        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            throw new Exception('Gagal menyimpan file');
        }

        return 'assets/personil/' . $new_filename;
    }

    // Routing API
    public function api(){
        header('Content-Type: application/json');
        
        $action = $_GET['action'] ?? $_POST['action'] ?? null;
        $response = ['success' => false, 'message' => 'Action tidak dikenali'];

        try {
            switch ($action) {
                case 'add': $response = $this->add(); break;
                case 'update': $response = $this->update(); break;
                case 'delete': $response = $this->delete(); break;
            }
        } catch (Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }

        echo json_encode($response);
        return;
    }

    private function add(){
        $nip = $_POST['nip'] ?? '';
        $nama = $_POST['nama'] ?? '';
        $email = $_POST['email'] ?? '';
        $jabatan = $_POST['jabatan'] ?? '';
        $ruang_dosen = $_POST['ruang_dosen'] ?? '';
        $linkedin = $_POST['linkedin'] ?? '';
        $github = $_POST['github'] ?? '';

        // Validasi
        if (empty($nip) || empty($nama) || empty($jabatan)) {
            return ['success' => false, 'message' => 'NIP, Nama, dan Jabatan harus diisi'];
        }

        // Handle photo upload
        $photo_url = handlePhotoUpload();

        // Buat JSON untuk content_social
        $content_social = null;
        
        if (!empty($linkedin) || !empty($github)) {
            $content_social = json_encode([
                'linkedin' => $linkedin,
                'github' => $github
            ]);
        }

        if ($model->addPersonil($nip, $nama, $email, $jabatan, $ruang_dosen, $content_social, $photo_url)) {
            return ['success' => true, 'message' => 'Data berhasil ditambahkan'];
        } else {
            return ['success' => false, 'message' => 'Gagal menambahkan data'];
        }
    }

    private function update(){
        $id_personil = $_POST['id_personil'] ?? 0;
        $nip = $_POST['nip'] ?? '';
        $nama = $_POST['nama'] ?? '';
        $email = $_POST['email'] ?? '';
        $jabatan = $_POST['jabatan'] ?? '';
        $ruang_dosen = $_POST['ruang_dosen'] ?? '';
        $linkedin = $_POST['linkedin'] ?? '';
        $github = $_POST['github'] ?? '';

        // Validasi
        if (empty($id_personil) || empty($nip) || empty($nama) || empty($jabatan)) {
            return ['success' => false, 'message' => 'Data tidak lengkap'];
        }

        // Handle photo upload (opsional untuk update)
        $photo_url = false; // false = tidak ada foto baru
        $old_personil = $model->getPersonilById($id_personil);
        
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photo_url = handlePhotoUpload();
            
            // Hapus foto lama jika ada
            if ($old_personil && !empty($old_personil['photo_url'])) {
                $old_photo_path = __DIR__ . '/../Views/' . $old_personil['photo_url'];
                if (file_exists($old_photo_path)) {
                    unlink($old_photo_path);
                }
            }
        }

        // Buat JSON untuk content_social
        $content_social = null;
        if (!empty($linkedin) || !empty($github)) {
            $content_social = json_encode([
                'linkedin' => $linkedin,
                'github' => $github
            ]);
        }

        // Jika tidak ada foto baru, gunakan foto lama
        if ($photo_url === false) {
            $photo_url = $old_personil['photo_url'] ?? null;
        }

        if ($model->updatePersonil($id_personil, $nip, $nama, $email, $jabatan, $ruang_dosen, $content_social, $photo_url)) {
            return ['success' => true, 'message' => 'Data berhasil diperbarui'];
        } else {
            return ['success' => false, 'message' => 'Gagal memperbarui data'];
        }
    }

    private function delete(){
        $id_personil = $_POST['id_personil'] ?? 0;

        // Validasi
        if (empty($id_personil)) {
            return ['success' => false, 'message' => 'ID tidak valid'];

        }

        // Hapus foto jika ada
        $personil = $model->getPersonilById($id_personil);
        if ($personil && !empty($personil['photo_url'])) {
            $photo_path = __DIR__ . '/../Views/' . $personil['photo_url'];
            if (file_exists($photo_path)) {
                @unlink($photo_path);
            }
        }

        if ($model->deletePersonil($id_personil)) {
            return ['success' => true, 'message' => 'Data berhasil dihapus'];
        } else {
            return ['success' => false, 'message' => 'Gagal menghapus data'];
        }
    }
}
?>
