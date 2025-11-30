<?php
include_once __DIR__ . '/../Controllers/AboutController.php';
include_once __DIR__ . '/../Controllers/authController.php';
include_once __DIR__ . '/../Controllers/RecruitmentController.php';

$aboutController = new AboutController();
$authController = new authController();
$recruitmentController = new RecruitmentController();

switch($_GET['action'] ?? ''){
    case 'visiMisi':
        $visi = $aboutController->getVisi();
        $misi = $aboutController->getMisi();
        include_once __DIR__ . '/../Views/visiMisi.php';
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
    case 'updateVisi':
        $visi = $_POST['visi'] ?? '';
        $aboutController->updateVisi($visi);
        break;
    case 'updateMisi':
        $misi = $_POST['misi'] ?? '';
        $aboutController->updateMisi($misi);
        break;
    default:
        include_once __DIR__ . '/../Views/home.php';
        break;
}

?>