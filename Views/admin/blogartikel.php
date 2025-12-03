<?php
require_once __DIR__ . '/../../Controllers/BlogController.php';
require_once __DIR__ . '/../../Models/KategoriModel.php';

// Ambil Data Artikel
$controller = new BlogController();
$artikelList = $controller->index();

// Ambil Data Kategori untuk Dropdown Modal
$kategoriModel = new KategoriModel();
$kategoriList = $kategoriModel->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Blog Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #F5F5F7;
            overflow-x: hidden;
        }

        /* Perbaikan CSS Layout */
        .main-content {
            padding: 30px;
            width: 100%;
            /* Mengisi sisa ruang di sebelah sidebar */
            overflow-y: auto;
            height: 100vh;
            /* Agar bisa discroll independen jika konten panjang */
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .table th {
            color: #6b7280;
            font-size: 14px;
            font-weight: 600;
        }

        .action-icon {
            font-size: 18px;
            cursor: pointer;
            margin-right: 10px;
        }

        .action-icon.edit {
            color: #3B82F6;
        }

        .action-icon.delete {
            color: #EF4444;
        }

        .thumb-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="d-flex">

        <?php include '../layout/sidebar.php'; ?>

        <div class="main-content">
            <h4 class="fw-bold mb-3">Pengelolaan Blog Artikel</h4>

            <div class="d-flex justify-content-between mb-3">
                <form action="" method="GET" class="w-25">
                    <input type="text" name="search" class="form-control" placeholder="Search..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                </form>

                <button class="btn btn-primary btnTambahArtikel">
                    <i class="bi bi-plus-lg"></i> Tambahkan Artikel
                </button>
            </div>

            <div class="table-container">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Author</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($artikelList)): ?>
                            <?php foreach ($artikelList as $index => $row): ?>
                                <tr
                                    data-id="<?= $row['id_artikel'] ?>"
                                    data-judul="<?= htmlspecialchars($row['title']) ?>"

                                    data-subtitle="<?= htmlspecialchars($row['subtitle']) ?>"
                                    data-kategori="<?= htmlspecialchars($row['kategori_id']) ?>"
                                    data-author="<?= htmlspecialchars($row['penulis']) ?>"
                                    data-tanggal="<?= date('Y-m-d', strtotime($row['tanggal_publikasi'])) ?>"
                                    data-deskripsi="<?= htmlspecialchars($row['isi_konten']) ?>"
                                    data-image="<?= htmlspecialchars($row['image_url'] ?? '') ?>">
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <img src="../<?= !empty($row['image_url']) ? $row['image_url'] : 'assets/bg.png' ?>" class="thumb-img" alt="img">
                                    </td>
                                    <td><?= htmlspecialchars($row['title']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_kategori'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($row['penulis']) ?></td>
                                    <td><?= date('d M Y', strtotime($row['tanggal_publikasi'])) ?></td>
                                    <td>
                                        <i class="bi bi-pencil-square action-icon edit"></i>
                                        <i class="bi bi-trash-fill action-icon delete"></i>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data artikel.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include 'blogArtikelModals.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>