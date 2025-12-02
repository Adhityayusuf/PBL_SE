<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Personil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main-content {
            padding: 30px;
            width: calc(100% - 270px);
        }

        .card {
            border: none;
            box-shadow: 0 0 10px rgba(170, 117, 117, 0.05);
            border-radius: 10px;
        }

        .sortable-header {
            cursor: pointer;
            user-select: none;
            color: #060606ff;
        }

        .sortable-header i {
            font-size: 0.7em;
            vertical-align: middle;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #060606ff;
            padding: 12px 16px;
            font-size: 0.85em;
        }

        .table tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            font-size: 0.8em;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-social {
            width: 25px;
            height: 25px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #0863C7;
            border: none;
            color: white;
            transition: background-color 0.3s ease;
        }

        .btn-social:hover {
            background-color: #054a8a;
        }

        .search-box {
            position: relative;
            max-width: 400px;
        }

        .search-box input {
            padding-left: 40px;
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
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
            background-color: #0863C7;
            color: white;
            border-color: #0863C7;
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
            <h3 class="fw-bold mb-4">Pengelolaan Personil</h3>
            <hr class="mt-0 mb-4">

            <!-- Search and Add Button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#personilModal" onclick="resetForm()">
                    <i class="bi bi-plus-lg me-2"></i>Tambahkan Dosen
                </button>
            </div>

            <!-- Table -->
            <div class="card p-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="sortable-header">Nama<i class="bi bi-caret-down-fill"></i></th>
                            <th class="sortable-header">NIP<i class="bi bi-caret-down-fill"></i></th>
                            <th class="sortable-header">Jabatan<i class="bi bi-caret-down-fill"></i></th>
                            <th class="sortable-header">Email<i class="bi bi-caret-down-fill"></i></th>
                            <th class="sortable-header">Ruang<i class="bi bi-caret-down-fill"></i></th>
                            <th class="sortable-header">Link<i class="bi bi-caret-down-fill"></i></th>
                            <th class="sortable-header">Action<i class="bi bi-caret-down-fill"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once __DIR__ . "/../../Core/Database.php";
                        require_once __DIR__ . "/../../Models/PersonilModel.php";

                        $model = new PersonilModel();
                        
                        // Paginasi
                        $items_per_page = 10;
                        $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                        
                        $all_personil = $model->getAllPersonil();
                        $total_items = count($all_personil);
                        $total_pages = ceil($total_items / $items_per_page);
                        
                        // Validasi halaman
                        if ($current_page > $total_pages && $total_pages > 0) {
                            $current_page = $total_pages;
                        }
                        
                        $offset = ($current_page - 1) * $items_per_page;
                        $personilList = array_slice($all_personil, $offset, $items_per_page);

                        foreach ($personilList as $person) {
                            $sosial = [];
                            if (!empty($person['content_sosial'])) {
                                $sosial = json_decode($person['content_sosial'], true) ?: [];
                            }
                            $linkedin = !empty($sosial['linkedin']) ? $sosial['linkedin'] : ($sosial['linkedin'] ?? '#');
                            $github = !empty($sosial['github']) ? $sosial['github'] : ($sosial['github'] ?? '#');
                            $email = !empty($person['email']) ? $person['email'] : '';

                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($person['nama']) . '</td>';
                            echo '<td>' . htmlspecialchars($person['nip']) . '</td>';
                            echo '<td>' . htmlspecialchars($person['jabatan']) . '</td>';
                            echo '<td>' . htmlspecialchars($email) . '</td>';
                            echo '<td>' . htmlspecialchars($person['ruang_dosen']) . '</td>';
                            echo '<td>';
                            echo '<a href="' . htmlspecialchars($linkedin) . '" class="btn-social me-1" target="_blank"><i class="bi bi-linkedin"></i></a>';
                            echo '<a href="' . htmlspecialchars($github) . '" class="btn-social" target="_blank"><i class="bi bi-github"></i></a>';
                            echo '</td>';
                            echo '<td>';
                            // edit button with data attributes
                            $dataAttr = 'data-id="' . $person['id_personil'] . '" '
                                     . 'data-nama="' . htmlspecialchars($person['nama'], ENT_QUOTES) . '" '
                                     . 'data-nip="' . htmlspecialchars($person['nip'], ENT_QUOTES) . '" '
                                     . 'data-jabatan="' . htmlspecialchars($person['jabatan'], ENT_QUOTES) . '" '
                                     . 'data-email="' . htmlspecialchars($email, ENT_QUOTES) . '" '
                                     . 'data-ruang="' . htmlspecialchars($person['ruang_dosen'], ENT_QUOTES) . '" '
                                     . 'data-linkedin="' . htmlspecialchars($linkedin, ENT_QUOTES) . '" '
                                     . 'data-github="' . htmlspecialchars($github, ENT_QUOTES) . '" '
                                     . 'data-photo="' . htmlspecialchars($person['photo_url'] ?? '', ENT_QUOTES) . '"';

                            echo '<button class="btn border-0 bg-transparent p-0 me-2" data-bs-toggle="modal" data-bs-target="#personilModal" onclick="editPersonil(this)" ' . $dataAttr . '><i class="bi bi-pencil-square text-primary fs-4"></i></button>';
                            echo '<button class="btn border-0 bg-transparent p-0" onclick="deletePersonil(' . intval($person['id_personil']) . ')"><i class="bi bi-trash text-danger fs-4"></i></button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <!-- Pagination Info -->
            <div class="text-center mt-3 mb-2">
                <small class="text-muted">
                    Menampilkan <?php echo !empty($personilList) ? $offset + 1 : 0; ?> - <?php echo min($offset + $items_per_page, $total_items); ?> dari <?php echo $total_items; ?> data
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
                            echo '<a class="page-link" href="?page=' . ($current_page - 1) . '" aria-label="Previous">';
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
                            echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                            if ($start_page > 2) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                        }
                        
                        for ($i = $start_page; $i <= $end_page; $i++) {
                            if ($i == $current_page) {
                                echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                            }
                        }
                        
                        if ($end_page < $total_pages) {
                            if ($end_page < $total_pages - 1) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                            echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                        }
                        
                        // Tombol Next
                        if ($current_page < $total_pages) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="?page=' . ($current_page + 1) . '" aria-label="Next">';
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

    <?php include 'personilModals.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function resetForm() {
            document.getElementById('personilModalLabel').textContent = 'Data Dosen';
            document.getElementById('personil-nama').value = '';
            document.getElementById('personil-nip').value = '';
            document.getElementById('personil-jabatan').value = '';
            document.getElementById('personil-email').value = '';
            document.getElementById('personil-ruang').value = '';
            document.getElementById('personil-github').value = '';
            document.getElementById('personil-linkedin').value = '';
            document.getElementById('personil-photo').value = '';
            document.getElementById('personil-id').value = '';
        }

        function editPersonil(button) {
            // button is the element with data-* attributes
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama') || '';
            const nip = button.getAttribute('data-nip') || '';
            const jabatan = button.getAttribute('data-jabatan') || '';
            const email = button.getAttribute('data-email') || '';
            const ruang = button.getAttribute('data-ruang') || '';
            const github = button.getAttribute('data-github') || '';
            const linkedin = button.getAttribute('data-linkedin') || '';
            const photo = button.getAttribute('data-photo') || '';

            document.getElementById('personilModalLabel').textContent = 'Edit Data Dosen';
            document.getElementById('personil-nama').value = nama;
            document.getElementById('personil-nip').value = nip;
            document.getElementById('personil-jabatan').value = jabatan;
            document.getElementById('personil-email').value = email;
            document.getElementById('personil-ruang').value = ruang;
            document.getElementById('personil-github').value = github;
            document.getElementById('personil-linkedin').value = linkedin;
            document.getElementById('personil-photo').value = photo;
            document.getElementById('personil-id').value = id;
        }

        function deletePersonil(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('id_personil', id);

                fetch('../../Controllers/personilController.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data berhasil dihapus');
                        location.reload(); // Reload page to refresh table
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menghapus data');
                });
            }
        }

        // Form submit handler
        document.getElementById('savePersonilBtn').addEventListener('click', function() {
            const id = document.getElementById('personil-id').value;
            const nama = document.getElementById('personil-nama').value;
            const nip = document.getElementById('personil-nip').value;
            const jabatan = document.getElementById('personil-jabatan').value;
            const email = document.getElementById('personil-email').value;
            const ruang = document.getElementById('personil-ruang').value;
            const github = document.getElementById('personil-github').value;
            const linkedin = document.getElementById('personil-linkedin').value;
            const photo = document.getElementById('personil-photo').value;

            // Validasi
            if (!nama || !nip || !jabatan) {
                alert('Nama, NIP, dan Jabatan harus diisi');
                return;
            }

            const formData = new FormData();
            
            if (id) {
                // Update mode
                formData.append('action', 'update');
                formData.append('id_personil', id);
            } else {
                // Add mode
                formData.append('action', 'add');
            }

            formData.append('nama', nama);
            formData.append('nip', nip);
            formData.append('jabatan', jabatan);
            formData.append('email', email);
            formData.append('ruang_dosen', ruang);
            formData.append('github', github);
            formData.append('linkedin', linkedin);
            formData.append('photo_url', photo);

            fetch('../../Controllers/personilController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Reload page to refresh table
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menyimpan data');
            });
        });
    </script>
</body>
</html>