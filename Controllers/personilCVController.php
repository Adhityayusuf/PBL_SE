<?php
require_once __DIR__ . "/../Models/PersonilCVModel.php";

class PersonilCVController
{
    private $model;
    private $upload_dir;

    public function __construct()
    {
        $this->model = new PersonilCVModel();
        $this->upload_dir = __DIR__ . '/../Views/assets/personil/';

        if (!is_dir($this->upload_dir)) {
            mkdir($this->upload_dir, 0755, true);
        }
    }

    public function indexDosen($id, $action)
    {
        $id_personil = $id;
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
    public function handleRequest()
    {
        $action = $_POST['action'] ?? '';
        $data = $_POST;
        switch ($action) {
            case 'penelitian':
                $this->handlePenelitian($data);
                break;
            case 'pengabdian':
                $this->handlePengabdian($data);
                break;
            case 'artikel_ilmiah':
                $this->handleArtikelIlmiah($data);
                break;
            case 'karya_buku':
                $this->handleKaryaBuku($data);
                break;
            case 'hki':
                $this->handleHKI($data);
                break;
            case 'identitas':
                $this->updateIdentitas($data);
                break;
            default:
                echo "Invalid section!";
                break;
        }
    }

    public function handleDeleteRequest(){
    
        $id_penelitian = $_POST['id_penelitian'] ?? '';
        $id_pengabdian = $_POST['id_pengabdian'] ?? '';
        $id_artikel = $_POST['id_artikel'] ?? '';
        $id_buku = $_POST['id_buku'] ?? '';
        $id_hki = $_POST['id_hki'] ?? '';
        $action = $_GET['action'] ?? '';
    
        switch ($action) {
                case 'deletePenelitian':
                    if (!empty($id_penelitian)){
                        $this->model->deletePenelitian($id_penelitian);
                        header("Location: /admin/index.php?action=penelitian");
                        exit();
                    } else {
                        header("Location: /admin/index.php?action=penelitian&error=invalid_id");
                        exit();
                    }
                    break;
                case 'deletePengabdian':
                    if (!empty($id_pengabdian)) {
                        $this->model->deletePengabdian($id_pengabdian);
                        header("Location: /admin/index.php?action=pengabdian");
                        exit();
                    } else {
                        header("Location: /admin/index.php?action=pengabdian&error=invalid_id");
                        exit();
                    }
                    break;
                case 'deleteArtikelIlmiah':
                    if(!empty($id_artikel)){
                        $this->model->deleteArtikelIlmiah($id_artikel);
                        header("Location: /admin/index.php?action=artikel_ilmiah");
                        exit();
                    } else {
                        header("Location: /admin/index.php?action=artikel_ilmiah&error=invalid_id");
                        exit();
                    }    
                    break;
                case 'deleteKaryaBuku':
                    if(!empty($id_buku)){
                        $this->model->deleteKaryaBuku($id_buku);
                        header("Location: /admin/index.php?action=karya_buku");
                        exit();
                    } else {
                        header("Location: /admin/index.php?action=karya_buku&error=invalid_id");
                        exit();
                    }
                    break;
                case 'deleteHKI':
                    if(!empty($id_hki))
                    $this->model->deleteHKI($id_hki);
                    header("Location: /admin/index.php?action=hki");
                    break;
                default:
                    echo "Invalid delete action!";
                    break;
        }
        
    }


    // HKI
    public function handleHKI($data){
        if (isset($data['id_hki']) && !empty($data['id_hki'])) {
            // Update HKI
           $this->model->updateHKI($data['id_hki'], $data);
           header("Location: /admin/index.php?action=hki");
        } else {
            // Add HKI
            $this->model->addHKI($data);
            header("Location: /admin/index.php?action=hki");
        }
    }
    private function handlePengabdian($data)
    {
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
    private function handlePenelitian($data)
    {
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

    // Artikel Ilmiah
    private function handleArtikelIlmiah($data){
        if (isset($data['id_artikel']) && !empty($data['id_artikel'])) {
            // Update Artikel Ilmiah
           $this->model->updateArtikelIlmiah($data['id_artikel'], $data);
           header("Location: /admin/index.php?action=artikel_ilmiah");
        } else {
            // Add Artikel Ilmiah
            $this->model->addArtikelIlmiah($data);
            header("Location: /admin/index.php?action=artikel_ilmiah");
        }
    }

    
    // Karya Buku
    private function handleKaryaBuku($data){
        if (isset($data['id_buku']) && !empty($data['id_buku'])) {
            // Update Karya Buku
           $this->model->updateKaryaBuku($data['id_buku'], $data);
           header("Location: /admin/index.php?action=buku");
        } else {
            // Add Karya Buku
            $this->model->addKaryaBuku($data);
            header("Location: /admin/index.php?action=buku");
        }
    }

    private function updateIdentitas($postData)
    {
        $id = $_POST['id_personil'] ?? 0;
        $photo_url = $this->handlePhotoUpload();

        // Susun array data untuk dikirim ke model
        $data = [
            'nip'            => $_POST['nip'] ?? '',
            'nidn'           => $_POST['nidn'] ?? '',
            'nama'           => $_POST['nama'] ?? '',
            'jenis_kelamin'  => $_POST['jenis_kelamin'] ?? '',
            'tempat_lahir'   => $_POST['tempat_lahir'] ?? '',
            'tgl_lahir'      => $_POST['tgl_lahir'] ?? null,
            'email'          => $_POST['email'] ?? '',
            'jabatan'        => $_POST['jabatan'] ?? '',
            'no_telp'        => $_POST['no_telp'] ?? '',
            'alamat_kantor'  => $_POST['alamat_kantor'] ?? '',
            'ruang_dosen'    => $_POST['ruang_dosen'] ?? '',
            'desc_diri'      => $_POST['desc_diri'] ?? '',
            'photo_url'      => $photo_url ?? '',

            // Kumpulkan input mhs_lulus dari form ke dalam satu array
            'mhs_lulus' => [
                'lulusan_s1' => $_POST['lulusan_s1'] ?? 0,
                'lulusan_s2' => $_POST['lulusan_s2'] ?? 0,
                'lulusan_s3' => $_POST['lulusan_s3'] ?? 0,
            ],

            // Default value untuk yang lainnya agar tidak undefined key
            'content_social' => [
                'linkedin' => $_POST['linkedin'] ?? '',
                'github'   => $_POST['github'] ?? ''
            ],
            'mata_kuliah' => $_POST['mata_kuliah'] ?? ''
        ];

        $mataKuliahRaw = $_POST['mata_kuliah'] ?? '';

        $mataKuliah = array_filter(
            array_map('trim', explode(',', $mataKuliahRaw))
        );

        $data['mata_kuliah'] = json_encode($mataKuliah, JSON_UNESCAPED_UNICODE);

        
        $this->model->updateIdentitas($id, $data);

        header("Location: /admin/index.php?action=identitas");
    }

    private function handlePhotoUpload()
    {
        if (!isset($_FILES['photo_url']) || $_FILES['photo_url']['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($_FILES['photo_url']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error upload file: ' . $_FILES['photo_url']['error']);
        }

        $file = $_FILES['photo_url'];
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
        $file_path = $this->upload_dir . $new_filename;

        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            throw new Exception('Gagal menyimpan file');
        }

        return '/Views/assets/personil/' . $new_filename;
    }
}
