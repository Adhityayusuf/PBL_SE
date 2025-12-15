<?php
require_once __DIR__ . "/../Models/PersonilCVModel.php";

class PersonilCVController
{
    private $model;

    public function __construct()
    {
        $this->model = new PersonilCVModel();
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
}
