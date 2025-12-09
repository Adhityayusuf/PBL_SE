<?php
$title = 'Pengelolaan Blog Artikel';

$customCSS = "
        body {
            background: #F5F5F7;
            overflow-x: hidden;
        }
        .main-content {
            padding: 30px;
            width: 100%;
            overflow-y: auto;
            height: 100vh;
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
        .action-icon.edit { color: #3B82F6; }
        .action-icon.delete { color: #EF4444; }
        .thumb-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        /* Pagination Styles */
        .pagination { margin: 0; gap: 8px; }
        .pagination .page-link {
            border: 1px solid #e0e0e0;
            color: #6c757d;
            padding: 8px 12px;
            border-radius: 6px;
            min-width: 40px;
            text-align: center;
            transition: all 0.3s ease;
            background-color: white; /* Tambahan agar terlihat jelas di background abu */
        }
        .pagination .page-link:hover {
            background-color: #f0f0f0;
            border-color: #d0d0d0;
        }
        .pagination .page-item.active .page-link {
            background-color: #0863C7;
            color: white;
            border-color: #0863C7;
            border-radius: 6px;
        }
        .pagination .page-item.disabled .page-link {
            background-color: #e9ecef; /* Sedikit lebih gelap untuk disabled state */
            border-color: #dee2e6;
            color: #adb5bd;
            cursor: not-allowed;
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
                    <input type="text" name="search" class="form-control" placeholder="Search..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
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
                        <?php 
                        // Nomor urut mengikuti pagination
                        $no = $offset + 1; 
                        foreach ($artikelList as $row): 
                        ?>
                            <tr
                                data-id="<?= $row['id_artikel'] ?>"
                                data-judul="<?= htmlspecialchars($row['title']) ?>"
                                data-subtitle="<?= htmlspecialchars($row['subtitle']) ?>"
                                data-kategori="<?= htmlspecialchars($row['kategori_id']) ?>"
                                data-author="<?= htmlspecialchars($row['penulis']) ?>"
                                data-tanggal="<?= date('Y-m-d', strtotime($row['tanggal_publikasi'])) ?>"
                                data-deskripsi="<?= htmlspecialchars($row['isi_konten']) ?>"
                                data-image="<?= htmlspecialchars($row['image_url'] ?? '') ?>">
                                <td><?= $no++ ?></td>
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
        <div class="text-center mt-3 mb-2">
            <small class="text-muted">
                Menampilkan <?php echo !empty($artikelList) ? $offset + 1 : 0; ?> - <?php echo min($offset + $items_per_page, $total_items); ?> dari <?php echo $total_items; ?> data
            </small>
        </div>

        <div class="d-flex justify-content-center mt-4 pb-5"> <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item <?php echo $current_page <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?php echo $current_page > 1 ? '?action=blog&page=' . ($current_page - 1) . $search_query : '#'; ?>">
                            Previous
                        </a>
                    </li>

                    <?php
                    $start_page = max(1, $current_page - 2);
                    $end_page = min($total_pages, $current_page + 2);

                    if ($start_page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?action=blog&page=1' . $search_query . '">1</a></li>';
                        if ($start_page > 2) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                    }

                    for ($i = $start_page; $i <= $end_page; $i++) {
                        $active = $i == $current_page ? 'active' : '';
                        echo '<li class="page-item ' . $active . '">
                            <a class="page-link" href="?action=blog&page=' . $i . $search_query . '">' . $i . '</a>
                            </li>';
                    }

                    if ($end_page < $total_pages) {
                        if ($end_page < $total_pages - 1) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                        echo '<li class="page-item"><a class="page-link" href="?action=blog&page=' . $total_pages . $search_query . '">' . $total_pages . '</a></li>';
                    }
                    ?>

                    <li class="page-item <?php echo $current_page >= $total_pages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?php echo $current_page < $total_pages ? '?action=blog&page=' . ($current_page + 1) . $search_query : '#'; ?>">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        </div>
</div>
<?php include 'blogArtikelModals.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>