<?php
include_once __DIR__ . '/Controllers/AboutController.php';
include_once __DIR__ . '/Controllers/authController.php';
include_once __DIR__ . '/Controllers/RecruitmentController.php';
include_once __DIR__ . '/Controllers/PersonilController.php';
include_once __DIR__ . '/Controllers/BlogController.php';
include_once __DIR__ . '/Controllers/HomeController.php';

$aboutController = new AboutController();
$authController = new authController();
$recruitmentController = new RecruitmentController();
$personilController = new PersonilController();
$blogController = new BlogController();
$homeController = new HomeController();

$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';

// ROUTE GET
if ($method === 'GET') {
    switch ($action) {

        case 'visiMisi': $aboutController->visiMisi(); break;
        case 'login': $authController->indexLogin(); break;
        case 'personil': $personilController->index();break;
        case 'recruitment': $recruitmentController->index(); break;
        case 'blog': $blogController->indexUser(); break;
        case 'artikel': // halaman detail artikel
            $id = $_GET['id'] ?? null;
            $blogController->show($id);
            break;
        case 'home': $homeController->index(); 
            break;
        default: header("Location: /index.php?action=home"); break;

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
        default:
            http_response_code(405);
            echo "POST endpoint tidak valid.";
            break;
    }
}
?>
