<?php
$title = 'Pengelolaan Blog Artikel';

$customCSS = "
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

        @media (max-width: 1400px) {
        .main-content {
            padding: 25px;
        }

        .table th, .table td {
            font-size: 14px;
        }
    }

    @media (max-width: 1200px) {
        .search-box input {
            font-size: 14px;
        }

        .thumb-img {
            width: 45px;
            height: 45px;
        }

        .table td, .table th {
            font-size: 13px;
        }
    }

    @media (max-width: 992px) {
        .main-content {
            padding: 20px;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 15px;
        }

        .btnTambahArtikel {
            width: 100%;
        }

        .search-box {
            width: 100% !important;
        }

        .table-container {
            padding: 15px;
        }
    }

    @media (max-width: 768px) {
        .table {
            font-size: 13px;
        }

        .thumb-img {
            width: 40px;
            height: 40px;
        }

        .main-content {
            padding: 15px;
            height: auto;
        }

        h4.fw-bold {
            font-size: 20px;
        }

        .input-group-text {
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .table th, .table td {
            font-size: 12px;
            white-space: nowrap;
        }

        .thumb-img {
            width: 35px;
            height: 35px;
        }

        .btnTambahArtikel {
            padding: 10px 14px;
            font-size: 14px;
        }

        .main-content {
            padding: 12px;
        }

        h4.fw-bold {
            font-size: 18px;
        }
    }
";
include_once __DIR__ . '/../layout/header.php';
?>
<div class="d-flex">

    <?php include __DIR__ . '/layout/sidebar.php'; ?>

    <div class="main-content">
        <h4 class="fw-bold mb-4">Pengelolaan Blog Artikel</h4>
        <hr class="mt-0 mb-4">

        <div class="d-flex justify-content-between mb-4">
            <form method="GET" class="position-relative" action="index.php">
                <input type="hidden" name="action" value="blog">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>

                    <input type="text" id="searchBlog" class="form-control" placeholder="Search">
                </div>
            </form>


            <button class="btn btn-primary btnTambahArtikel">
                <i class="bi bi-plus-lg"></i> Tambahkan Artikel
            </button>
        </div>

        <div class="table-container">
            <table class="table align-middle" id="blogTable">
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
                                    <img src="<?= !empty($row['image_url']) ? $row['image_url'] : 'assets/bg.png' ?>" class="thumb-img" alt="img">
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchBox = document.getElementById("searchBlog");
        const rows = document.querySelectorAll("#blogTable tbody tr");

        searchBox.addEventListener("keyup", function() {
            const keyword = this.value.toLowerCase();

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(keyword) ? "" : "none";
            });
        });
    });
</script>
</body>

</html>