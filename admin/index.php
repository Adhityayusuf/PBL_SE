<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || !isset($_SESSION['email'])) {
    header("Location: ../index.php?action=login");
    exit;
}

include_once __DIR__ . '/../Controllers/AdminProfileController.php';
include_once __DIR__ . '/../Controllers/PersonilController.php';
include_once __DIR__ . '/../Controllers/PersonilCVController.php';
include_once __DIR__ . '/../Controllers/BlogController.php';
include_once __DIR__ . '/../Controllers/AuthController.php';
include_once __DIR__ . '/../Controllers/geekController.php';

$adminProfile = new AdminProfileController();
$personilController = new PersonilController();
$personilCVController = new PersonilCVController();
$blogController = new BlogController();
$geekController = new GeekController();

$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? 'dashboard';

if ($method === 'GET') {
    switch ($action) {
        case 'personil':
            if ($_SESSION['role'] === 'admin') {
                $personilController->indexAdmin(); // halaman admin
            } else {
                http_response_code(403);
                echo "Akses ditolak.";
            }
            break;
        case 'blog': 
            if ($_SESSION['role'] === 'admin') {
                $blogController->showAdminArtikel(); // semua artikel
            } elseif ($_SESSION['role'] === 'dosen') {
                $blogController->showAdminArtikel($_SESSION['user_id']); // filter artikel milik dosen
            } else {
                http_response_code(403);
                echo "Akses ditolak.";
            }
            break;
        case 'dashboard':
        case 'identitas':
        case 'riwayat':
        case 'penelitian':
        case 'pengabdian':
        case 'artikel_ilmiah':
        case 'karya_buku':
        case 'hki':
            $user_id = $_SESSION['user_id'];
            $target_id = $user_id;

            if ($_SESSION['role'] === 'dosen' && $target_id !== $user_id) {
                http_response_code(403);
                echo "Akses ditolak: Anda hanya dapat melihat data pribadi.";
                break;
            }
            $personilCVController->indexDosen($target_id, $action); 
            break;
        case 'segeeks': 
            $geekController->index();
            break;
        case 'settings': 
            $adminProfile->settings();
            break;
        case 'profil': 
        case 'dashboard_profil':
            $personilCVController->index();
        default: 
            $adminProfile->index();
            break;
    }
}

if ($method === 'POST') {
    switch ($action) {
        case 'update_tentang':
        case 'update_visi':
        case 'update_misi':
        case 'save_scope':
        case 'delete_scope':
        case 'save_roadmap':
        case 'delete_roadmap':
        case 'update_prestasi':
        case 'delete_prestasi':
            $adminProfile->handleRequest();
            break;
        case 'add':
        case 'update':
        case 'delete':
            if ($_SESSION['role'] === 'admin' || ($_SESSION['role'] === 'dosen' && $action === 'update')) {
                $personilController->api();
            } else {
                http_response_code(403);
                echo "Akses ditolak.";
            }
            break;
        case 'addArtikel':
        case 'editArtikel':
        case 'deleteArtikel':
            $blogController->handleRequest();
            break;
        case 'updateVisi':
            $profile->updateVisi($_POST['visi']);
            break;
        case 'updateMisi':
            $profile->updateMisi($_POST['misi']);
            break;
        case 'approveGeek':
            $geekController->approve();
            break;
        case 'deleteGeek' :
            $geekController->delete();
            break;
        case 'penelitian':
        case 'pengabdian':
            $personilCVController->handleRequest();
            break;
        case 'deletePenelitian':
            if (isset($_POST['id_penelitian'])) {
                $personilCVController->handleDeleteRequest($_POST['id_penelitian']);
            } else {
                http_response_code(400);
                echo "ID Penelitian tidak disediakan.";
            }
            break;
        default:
            http_response_code(405);
            echo "POST admin endpoint tidak valid.";
    }
}