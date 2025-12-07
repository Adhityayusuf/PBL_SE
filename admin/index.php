<?php

session_start();

if (!isset($_SESSION['uadmin'])) {
    header("Location: ../index.php?action=login");
    exit;
}

include_once __DIR__ . '/../Controllers/AdminProfileController.php';
include_once __DIR__ . '/../Controllers/PersonilController.php';
include_once __DIR__ . '/../Controllers/BlogController.php';
include_once __DIR__ . '/../Controllers/AuthController.php';
include_once __DIR__ . '/../Controllers/geekController.php';

// include_once __DIR__ . '/../Controllers/AdminSettingsController.php';

$adminProfile = new AdminProfileController();
$personilController = new PersonilController();
$blogController = new BlogController();
$geekController = new GeekController();
// $settingsController = new AdminSettingsController();

$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? 'dashboard';

if ($method === 'GET') {
    switch ($action) {
        case 'personil': 
            $personilController->indexAdmin();
            break;
        case 'blog': 
            $blogController->showAdminArtikel();
            break;
        case 'segeeks': 
            $geekController->index();
            break;
        case 'profil': 
        default: 
            $adminProfile->index();
            break;
    }
}

if ($method === 'POST') {
    switch ($action) {
        case 'update_tentang':
        case 'update_visimisi':
        case 'save_scope':
        case 'delete_scope':
        case 'save_roadmap':
        case 'delete_roadmap';
            $adminProfile->handleRequest();
            break;
        case 'add':
        case 'update':
        case 'delete':
            $personilController->api(); // khusus admin CRUD
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
        default:
            http_response_code(405);
            echo "POST admin endpoint tidak valid.";
    }
}