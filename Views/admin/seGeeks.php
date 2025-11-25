<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan SE Geeks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body { background-color: #f8f9fa; }
        .main-content {
            padding: 30px;
            width: calc(100% - 270px); 
        }
        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 10px;
        }
        
        /* Styling Badge Status */
        .status-badge {
            font-size: 0.85em;
            padding: 0.3em 0.8em;
            border-radius: 20px;
            font-weight: 500;
            display: inline-block; 
        }
        .status-ditolak { background-color: #fce7e7; color: #dc3545; }
        .status-menunggu { background-color: #fff3e0; color: #ffc107; }
        .status-diterima { background-color: #e6f7e6; color: #28a745; }

        /* Styling Header Tabel yang dapat diurutkan */
        .sortable-header {
            cursor: pointer;
            user-select: none;
            color: #333; 
        }
        .sortable-header i {
            font-size: 0.7em;
            vertical-align: middle;
        }
        
        /* Search box styling */
        .search-box {
            position: relative;
            width: 320px;
        }
        .search-box input {
            padding-left: 40px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 0.95rem;
        }
        .search-box input::placeholder {
            color: #999;
        }
        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 1.1rem;
            pointer-events: none;
        }

        /* tombol actions*/
        .action-button-bg {
            display: inline-block;
            padding: 5px 20px; 
            border-radius: 20px; 
            font-size: 0.9em;
            font-weight: 500;
            text-decoration: none;
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .action-setujui {
            background-color: #e6f7e6; 
            color: #28a745 !important;
        }
        .action-hapus {
            background-color: #fce7e7; 
            color: #dc3545 !important;
        }
        /* Hover effect */
        .action-setujui:hover { background-color: #d4f0d4; }
        .action-hapus:hover { background-color: #fbd6d6; }

        /* Pagination styling */
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
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd;
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
        <?php 
        include '../layout/sidebar.php'; 
        ?>

        <div class="main-content">
            <h3 class="fw-bold mb-4">Pengelolaan SE Geeks</h3>
            <hr class="mt-0 mb-4">
            
            <div class="d-flex justify-content-end mb-3">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </div>

            <div class="card p-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="sortable-header">Nama <i class="bi bi-caret-down-fill"></i></th>
                                <th class="sortable-header">NIM <i class="bi bi-caret-down-fill"></i></th>
                                <th class="sortable-header">Program Studi <i class="bi bi-caret-down-fill"></i></th>
                                <th class="sortable-header">Angkatan <i class="bi bi-caret-down-fill"></i></th>
                                <th class="sortable-header">Status <i class="bi bi-caret-down-fill"></i></th>
                                <th class="sortable-header">Action <i class="bi bi-caret-down-fill"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data_geeks = [
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Ditolak'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Menunggu'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Ditolak'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Diterima'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Ditolak'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Menunggu'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Ditolak'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Diterima'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Ditolak'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Ditolak'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Ditolak'],
                                ['nama' => 'Lorem Ipsum', 'nim' => '1234567B', 'prodi' => 'Informatika', 'angkatan' => 2025, 'status' => 'Ditolak'],
                            ];

                            foreach ($data_geeks as $geek) {
                                $status_class = match($geek['status']) {
                                    'Ditolak' => 'status-ditolak',
                                    'Menunggu' => 'status-menunggu',
                                    'Diterima' => 'status-diterima',
                                    default => ''
                                };
                                $nim = $geek['nim'];
                                echo "<tr>";
                                echo "<td>" . $geek['nama'] . "</td>";
                                echo "<td>" . $geek['nim'] . "</td>";
                                echo "<td>" . $geek['prodi'] . "</td>";
                                echo "<td>" . $geek['angkatan'] . "</td>";
                                echo "<td><span class='status-badge $status_class'>" . $geek['status'] . "</span></td>";
                                echo "<td>";
                                // Tombol Setujui
                                echo "<a href='#' class='action-button-bg action-setujui' data-action='setujui' data-nim='$nim'><i class='bi bi-check-circle-fill'></i> Setujui</a>";
                                // Tombol Hapus
                                echo "<a href='#' class='action-button-bg action-hapus' data-action='hapus' data-nim='$nim'><i class='bi bi-trash-fill'></i> Hapus</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">Previous</span>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // klik tombol Setujui/Hapus
        document.querySelectorAll('.action-button-bg').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const action = this.getAttribute('data-action');
                const nim = this.getAttribute('data-nim');
                
                if (action === 'setujui') {
                    alert(`Mengirim persetujuan untuk NIM: ${nim}`);
                } else if (action === 'hapus') {
                    if (confirm(`Anda yakin ingin menghapus data NIM: ${nim}?`)) {
                        alert(`Menghapus data untuk NIM: ${nim}`);
                    }
                }
            });
        });
        
        // simulasi fungsi sorting
        document.querySelectorAll('.sortable-header').forEach(header => {
            header.addEventListener('click', function() {
                console.log(`Sorting berdasarkan kolom: ${this.textContent.trim().split(' ')[0]}`);
            });
        });
    </script>
</body>
</html>