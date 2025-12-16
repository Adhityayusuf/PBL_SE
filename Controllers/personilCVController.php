<?php
require_once __DIR__ . "/../Models/PersonilCVModel.php";

class PersonilCVController
{
    private $model;

    public function __construct()
    {
        $this->model = new PersonilCVModel();
    }

    public function indexDosen($id, $action) {
        $id_personil = 8;
        $data = $this->model->getAllCVData($id_personil); 

        // Definisikan variabel yang dibutuhkan View (extract lebih disarankan, tapi kita gunakan cara manual agar eksplisit)
        $personil   = $data['personil'];
        $stats      = $data['stats'];
        $pendidikan = $data['pendidikan'];
        $penelitian = $data['penelitian'];
        $pengabdian = $data['pengabdian'];
        $artikel    = $data['artikel'];
        $buku       = $data['buku'];
        $hki        = $data['hki'];
        
        // Variabel tambahan untuk View Dosen (personil_admin)
        $user_role = 'dosen';
        $personil_id = $id_personil;
        $nama_dosen = $personil['nama'] ?? 'N/A';
        
        switch ($action) {
            case 'dashboard':
                require_once __DIR__ . '/../Views/personil_admin/dashboard_profile.php';
                break;
            case 'riwayat':
                require_once __DIR__ . '/../Views/personil_admin/riwayat_pendidikan.php';
                break;
            case 'identitas':
                require_once __DIR__ . '/../Views/personil_admin/identitas.php';
                break;
            case 'penelitian':
                require_once __DIR__ . '/../Views/personil_admin/penelitian.php';
                break;
            case 'pengabdian':
                require_once __DIR__ . '/../Views/personil_admin/pengabdian.php';
                break;
            case 'artikel_ilmiah':
                require_once __DIR__ . '/../Views/personil_admin/artikel_ilmiah.php';
                break;
            case 'karya_buku':
                require_once __DIR__ . '/../Views/personil_admin/karya_buku.php';
                break;
            case 'hki':
                require_once __DIR__ . '/../Views/personil_admin/hki.php';
                break;
            case 'riwayat':
                require_once __DIR__ . '/../Views/personil_cv/riwayat_pendidikan.php';
                break;
            default:
                $this->index($id, $action);
                break;
        }
    }

    public function index($id, $action) // Ditambahkan $action
    {
        $id_personil = $id ?? 1;
        $data = $this->model->getAllCVData($id_personil); // Model tidak perlu $action

        $personil   = $data['personil'];
        $stats      = $data['stats'];
        $pendidikan = $data['pendidikan'];
        $penelitian = $data['penelitian'];
        $pengabdian = $data['pengabdian'];
        $artikel    = $data['artikel'];
        $buku       = $data['buku'];
        $hki        = $data['hki'];

        switch ($action) {
            case 'dashboard':
                require_once __DIR__ . '/../Views/personil_cv/dashboard.php';
                break;
            case 'identitas':
                require_once __DIR__ . '/../Views/personil_cv/identitas.php';
                break;
            case 'riwayat':
                require_once __DIR__ . '/../Views/personil_cv/riwayat_pendidikan.php';
                break;
            case 'penelitian':
                require_once __DIR__ . '/../Views/personil_cv/penelitian.php';
                break;
            case 'pengabdian':
                require_once __DIR__ . '/../Views/personil_cv/pengabdian.php';
                break;
            case 'artikel-ilmiah':
                require_once __DIR__ . '/../Views/personil_cv/artikel_ilmiah.php';
                break;
            case 'buku':
                require_once __DIR__ . '/../Views/personil_cv/karya_buku.php';
                break;
            case 'hki':
                require_once __DIR__ . '/../Views/personil_cv/hki.php';
                break;
            default:
                // Handle default atau error case jika diperlukan
                echo "<h2>Section CV tidak ditemukan</h2>";
                break;
        }
    }
// HANDLE POST
    public function handleRequest(){
        $action = $_POST['action'] ?? '';
        $data = $_POST;

        switch ($action) {
                case 'penelitian':
                    $this->handlePenelitian($data);
                    break;
                case 'pengabdian':
                    $this->handlePengabdian($data);
                    break;
                default:
                    echo "Invalid section!";
                    break;
        }
        
    }

    public function handleDeleteRequest(){
        $action = $_GET['action'] ?? '';
        $id_penelitian = $_GET['id_penelitian'] ?? '';

        switch ($action) {
                case 'deletePenelitian':
                    $this->deletePenelitian($id_penelitian);
                    break;
                default:
                    echo "Invalid delete action!";
                    break;
        }
        
    }
    private function handlePengabdian($data){
        if (isset($data['id_pengabdian']) && !empty($data['id_pengabdian'])) {
            // Update Pengabdian
           $this->model->updatePengabdian($data['id_pengabdian'], $data);
           header("Location: /admin/index.php?action=pengabdian");
        } else {
            // Add Pengabdian
            $this->model->addPengabdian($data);
            header("Location: /admin/index.php?action=pengabdian");
        }
    }

    // Penelitian
    private function handlePenelitian($data){
        if (isset($data['id_penelitian']) && !empty($data['id_penelitian'])) {
            // Update Penelitian
           $this->model->updatePenelitian($data['id_penelitian'], $data);
           header("Location: /admin/index.php?action=penelitian");
        } else {
            // Add Penelitian
            $this->model->addPenelitian($data);
            header("Location: /admin/index.php?action=penelitian");
        }
    }

    private function deletePenelitian($id_penelitian){
        $this->model->deletePenelitian($id_penelitian);
        header("Location: /admin/index.php?action=penelitian");
    }
}