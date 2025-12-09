<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan SE Geeks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
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

        /* Badge Status */
        .status-badge {
            font-size: 0.85em;
            padding: 0.3em 0.8em;
            border-radius: 20px;
            font-weight: 500;
            display: inline-block;
        }

        .status-menunggu {
            background-color: #fff3e0;
            color: #ff9800;
        }

        .status-diterima {
            background-color: #e6f7e6;
            color: #28a745;
        }

        /* Action Button */
        .action-button-bg {
            padding: 5px 20px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 500;
            cursor: pointer;
            border: none;
        }

        .action-setujui {
            background-color: #e6f7e6;
            color: #28a745;
        }

        .action-hapus {
            background-color: #fce7e7;
            color: #dc3545;
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

            .main-content {
                padding: 15px;
                height: auto;
            }

            h3.fw-bold {
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

            .btnTambahArtikel {
                padding: 10px 14px;
                font-size: 14px;
            }

            .main-content {
                padding: 12px;
            }

            h3.fw-bold {
                font-size: 18px;
            }
        }

        .pagination {
            margin: 0;
            gap: 8px;
        }

        .pagination .page-link {
            border: 1px solid #e0e0e0;
            color: #6c757d;
            padding: 8px 12px;
            border-radius: 6px;
            min-width: 40px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #f0f0f0;
            border-color: #d0d0d0;
        }

        .pagination .page-item.active .page-link {
            background-color: #06315A;
            color: white;
            border-color: #06315A;
            border-radius: 6px;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f0f0f0;
            border-color: #e0e0e0;
            color: #adb5bd;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <?php include __DIR__ . '/layout/sidebar.php'; ?>

        <div class="main-content">
            <h3 class="fw-bold mb-4">Pengelolaan SE Geeks</h3>
            <hr class="mt-0 mb-4">

            <div class="input-group mb-3" style="max-width: 245px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" id="searchBox" class="form-control" placeholder="Cari...">
            </div>

            <div class="table-container">
                <table class="table align-middle" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th>Minat</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($data as $geek): ?>
                                <?php
                                $status_class = match ($geek['status']) {
                                    'menunggu' => 'status-menunggu',
                                    'disetujui' => 'status-diterima',
                                    default => ''
                                };
                                ?>

                                <tr>
                                    <td><?= $geek['nama'] ?></td>
                                    <td><?= $geek['nim'] ?></td>
                                    <td><?= $geek['prodi'] ?></td>
                                    <td><?= $geek['angkatan'] ?></td>
                                    <td><?= $geek['minat'] ?></td>

                                    <td>
                                        <span class="status-badge <?= $status_class ?>">
                                            <?= $geek['status'] ?>
                                        </span>
                                    </td>

                                    <td>

                                        <?php if ($geek['status'] !== 'disetujui'): ?>
                                            <form method="POST" action="index.php" style="display:inline;">
                                                <input type="hidden" name="action" value="approveGeek">
                                                <input type="hidden" name="nim" value="<?= $geek['nim'] ?>">
                                                <button type="submit" class="action-button-bg action-setujui">
                                                    <i class="bi bi-check-circle-fill"></i> Setujui
                                                </button>
                                            </form>
                                        <?php endif; ?>


                                        <form method="POST" action="index.php" style="display:inline;"
                                            onsubmit="return confirm('Anda yakin ingin menghapus?')">
                                            <input type="hidden" name="action" value="deleteGeek">
                                            <input type="hidden" name="nim" value="<?= $geek['nim'] ?>">
                                            <button type="submit" class="action-button-bg action-hapus">
                                                <i class="bi bi-trash-fill"></i> Hapus
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>

                    </table>
                </div>

                <!-- Pagination Info -->
                <div class="text-center mt-3 mb-2">
                    <small class="text-muted">
                        Menampilkan <?php echo !empty($data) ? $offset + 1 : 0; ?> - <?php echo min($offset + $items_per_page, $total_items); ?> dari <?php echo $total_items; ?> data
                    </small>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php
                            // Tombol Previous
                            if ($current_page > 1) {
                                echo '<li class="page-item">';
                                echo '<a class="page-link" href="index.php?action=segeeks&page=' . ($current_page - 1) . $search_query . '" aria-label="Previous">';
                                echo '<span aria-hidden="true">Previous</span>';
                                echo '</a></li>';
                            } else {
                                echo '<li class="page-item disabled">';
                                echo '<span class="page-link">Previous</span>';
                                echo '</li>';
                            }

                            // Nomor halaman
                            $start_page = max(1, $current_page - 2);
                            $end_page = min($total_pages, $current_page + 2);

                            if ($start_page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="index.php?action=segeeks&page=1' . $search_query . '">1</a></li>';
                                if ($start_page > 2) {
                                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                }
                            }

                            for ($i = $start_page; $i <= $end_page; $i++) {
                                if ($i == $current_page) {
                                    echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="index.php?action=segeeks&page=' . $i . $search_query . '">' . $i . '</a></li>';
                                }
                            }

                            if ($end_page < $total_pages) {
                                if ($end_page < $total_pages - 1) {
                                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                }
                                echo '<li class="page-item"><a class="page-link" href="index.php?action=segeeks&page=' . $total_pages . $search_query . '">' . $total_pages . '</a></li>';
                            }

                            // Tombol Next
                            if ($current_page < $total_pages) {
                                echo '<li class="page-item">';
                                echo '<a class="page-link" href="index.php?action=segeeks&page=' . ($current_page + 1) . $search_query . '" aria-label="Next">';
                                echo '<span aria-hidden="true">Next</span>';
                                echo '</a></li>';
                            } else {
                                echo '<li class="page-item disabled">';
                                echo '<span class="page-link">Next</span>';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchBox = document.getElementById("searchBox");
            const rows = document.querySelectorAll("#dataTable tbody tr");

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