<?php
include_once __DIR__ . '/../Controllers/aboutController.php';
include_once __DIR__ . '/../Controllers/authController.php';
include_once __DIR__ . '/../Controllers/personilController.php';
include_once __DIR__ . '/../Controllers/HomeController.php';

$aboutController = new aboutController();
$authController = new authController();

switch($_GET['action'] ?? ''){
    case 'visiMisi':
        $aboutController->visiMisi(); 
        break;
    case 'login':
        $authController->indexLogin();
        break;
    case 'logindo':
        $authController->login($_POST['username'], $_POST['password']);
        break;
    case 'personil':
        $personilController = new PersonilController();
        $dosenList = $personilController->getDosenList();
        include_once __DIR__ . '/../Views/personil.php';
        break;
    case 'home':
        include_once __DIR__ . '/../Views/home.php';
        break;
    case 'blog':
        include_once __DIR__ . '/../Views/blog.php';
        break;
    case 'recruitment':
        $recruitmentController->index();
        include_once __DIR__ . '/../Views/recruitment.php';
        break;
    default:
        include_once __DIR__ . '/../Views/home.php';
        break;
}

?>