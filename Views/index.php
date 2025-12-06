<?php
include_once __DIR__ . '/../Controllers/AboutController.php';
include_once __DIR__ . '/../Controllers/authController.php';
include_once __DIR__ . '/../Controllers/RecruitmentController.php';
include_once __DIR__ . '/../Controllers/PersonilController.php';

$aboutController = new AboutController();
$authController = new authController();
$recruitmentController = new RecruitmentController();
$personilController = new PersonilController();

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

// ROUTE GET
if ($method === 'GET') {
    switch ($action) {

        case 'visiMisi':
            $aboutController->visiMisi();
            break;

        case 'login':
            $authController->indexLogin();
            break;

        case 'personil':
            $personilController->index();
            break;

        case 'recruitment':
            $recruitmentController->index();
            break;

        case 'blog':
            include_once __DIR__ . '/../Views/blog.php';
            break;

        case 'home':
        default:
            include_once __DIR__ . '/../Views/home.php';
            break;
    }
}

// ROUTE POST
if ($method === 'POST') {
    switch ($action) {
        case 'logindo':
            $authController->login($_POST['username'], $_POST['password']);
            break;

        case 'recruitmentAdd':
            $recruitmentController->addMahasiswa($_POST);
            break;

        case 'updateVisi':
            $aboutController->updateVisi($_POST['visi'] ?? '');
            break;

        case 'updateMisi':
            $aboutController->updateMisi($_POST['misi'] ?? '');
            break;

        default:
            http_response_code(405);
            echo "POST endpoint tidak valid.";
            break;
    }
}
?>
