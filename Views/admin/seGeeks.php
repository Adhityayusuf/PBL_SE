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