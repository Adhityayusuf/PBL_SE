<?php

require_once __DIR__ . "/../Core/Database.php";
require_once __DIR__ . "/../Models/PersonilModel.php";

header('Content-Type: application/json');

$action = $_GET['action'] ?? $_POST['action'] ?? null;
$model = new PersonilModel();
$response = ['success' => false, 'message' => 'Action not found'];

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
            $photo_url = $_POST['photo_url'] ?? '';

            // Validasi
            if (empty($nip) || empty($nama) || empty($jabatan)) {
                $response = ['success' => false, 'message' => 'NIP, Nama, dan Jabatan harus diisi'];
                break;
            }

            // Buat JSON untuk content_sosial
            $content_sosial = null;
            if (!empty($linkedin) || !empty($github)) {
                $content_sosial = json_encode([
                    'linkedin' => $linkedin,
                    'github' => $github
                ]);
            }

            if ($model->addPersonil($nip, $nama, $email, $jabatan, $ruang_dosen, $content_sosial, $photo_url)) {
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
            $photo_url = $_POST['photo_url'] ?? '';

            // Validasi
            if (empty($id_personil) || empty($nip) || empty($nama) || empty($jabatan)) {
                $response = ['success' => false, 'message' => 'Data tidak lengkap'];
                break;
            }

            // Buat JSON untuk content_sosial
            $content_sosial = null;
            if (!empty($linkedin) || !empty($github)) {
                $content_sosial = json_encode([
                    'linkedin' => $linkedin,
                    'github' => $github
                ]);
            }

            if ($model->updatePersonil($id_personil, $nip, $nama, $email, $jabatan, $ruang_dosen, $content_sosial, $photo_url)) {
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
