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
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $start = ($page - 1) * $per_page;

        $data = $model->getPaged($start, $per_page);
        $total = $model->countAll();
        $total_pages = ceil($total / $per_page);

        // Variables for pagination
        $offset = $start;
        $items_per_page = $per_page;
        $total_items = $total;
        $current_page = $page;
        $search_query = isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '';

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
    
    public function arsip()
    {
        $nim = $_POST['nim'] ?? null;
        if ($nim) {
            $this->model->arsip($nim);
        }
        header("Location: /admin/index.php?action=segeeks");
    }
    
    public function tolak()
    {
        $nim = $_POST['nim'] ?? null;
        if ($nim) {
            $this->model->tolak($nim);
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
