<?php

require_once __DIR__ . "/../Core/Database.php";
require_once __DIR__ . "/../Models/PersonilModel.php";

header('Content-Type: application/json');

$action = $_GET['action'] ?? $_POST['action'] ?? null;
$model = new PersonilModel();
$response = ['success' => false, 'message' => 'Action not found'];

// Folder untuk upload
$upload_dir = __DIR__ . '/../Views/assets/personil/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Fungsi untuk handle upload file
function handlePhotoUpload() {
    global $upload_dir;
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

try {
    switch ($action) {
        case 'add':
            $nip = $_POST['nip'] ?? '';
            $nama = $_POST['nama'] ?? '';
            $email = $_POST['email'] ?? '';
            $jabatan = $_POST['jabatan'] ?? '';
            $ruang_dosen = $_POST['ruang_dosen'] ?? '';
            $linkedin = $_POST['linkedin'] ?? '';
            $github = $_POST['github'] ?? '';

            // Validasi
            if (empty($nip) || empty($nama) || empty($jabatan)) {
                $response = ['success' => false, 'message' => 'NIP, Nama, dan Jabatan harus diisi'];
                break;
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
                $response = ['success' => true, 'message' => 'Data berhasil ditambahkan'];
            } else {
                $response = ['success' => false, 'message' => 'Gagal menambahkan data'];
            }
            break;

        case 'update':
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
                $response = ['success' => false, 'message' => 'Data tidak lengkap'];
                break;
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
                $response = ['success' => true, 'message' => 'Data berhasil diperbarui'];
            } else {
                $response = ['success' => false, 'message' => 'Gagal memperbarui data'];
            }
            break;

        case 'delete':
            $id_personil = $_POST['id_personil'] ?? 0;

            if (empty($id_personil)) {
                $response = ['success' => false, 'message' => 'ID tidak valid'];
                break;
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
                $response = ['success' => true, 'message' => 'Data berhasil dihapus'];
            } else {
                $response = ['success' => false, 'message' => 'Gagal menghapus data'];
            }
            break;

        default:
            $response = ['success' => false, 'message' => 'Action tidak dikenali'];
            break;
    }
} catch (Exception $e) {
    $response = ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
}

echo json_encode($response);
?>
