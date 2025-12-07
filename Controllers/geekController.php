<?php
require_once __DIR__ . '/../Models/GeeksModel.php';

class GeekController
{
    private $model;

    public function __construct()
    {
        $this->model = new GeekModel();
    }

    public function index()
    {
        $model = new GeekModel();

        $per_page = 10; // 10 data per halaman
        $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        if ($page < 1) $page = 1;

        $start = ($page - 1) * $per_page;

        $data = $model->getPaged($start, $per_page);
        $total = $model->countAll();
        $total_pages = ceil($total / $per_page);

        include __DIR__ . '/../Views/admin/seGeeks.php';
    }

    public function approve()
    {
        $nim = $_POST['nim'] ?? null;
        if ($nim) {
            $this->model->approve($nim);
        }
        header("Location: /admin/index.php?action=segeeks");
    }

    public function delete()
    {
        $nim = $_POST['nim'] ?? null;
        if ($nim) {
            $this->model->delete($nim);
        }
        header("Location: /admin/index.php?action=segeeks");
    }
}
