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
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 10px;
        }
        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
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
            color: #495057;
            padding: 12px 16px;
        }
        .table tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            font-size: 0.85em;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }
        .btn-social {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #0077b5;
            border: none;
            color: white;
        }
        .btn-social:hover {
            background-color: #005885;
            color: white;
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
        }
        .pagination .page-link {
            border: none;
            color: #6c757d;
            padding: 8px 12px;
        }
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            color: white;
            border-radius: 6px;
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
                        // Sample data - replace with database query
                        $personilData = [
                            ['nama' => 'Ketiwav Goreng', 'nip' => '123456789876', 'jabatan' => 'Ketua Lab', 'email' => 'dipshey@polinema.ac.id', 'ruang' => 'Ruang Dosen 3', 'linkedin' => '#', 'github' => '#'],
                            ['nama' => 'Ketiwav Goreng', 'nip' => '123456789876', 'jabatan' => 'Ketua Lab', 'email' => 'dipshey@polinema.ac.id', 'ruang' => 'Ruang Dosen 3', 'linkedin' => '#', 'github' => '#'],
                            ['nama' => 'Ketiwav Goreng', 'nip' => '123456789876', 'jabatan' => 'Ketua Lab', 'email' => 'dipshey@polinema.ac.id', 'ruang' => 'Ruang Dosen 3', 'linkedin' => '#', 'github' => '#'],
                            ['nama' => 'Ketiwav Goreng', 'nip' => '123456789876', 'jabatan' => 'Ketua Lab', 'email' => 'dipshey@polinema.ac.id', 'ruang' => 'Ruang Dosen 3', 'linkedin' => '#', 'github' => '#'],
                            ['nama' => 'Ketiwav Goreng', 'nip' => '123456789876', 'jabatan' => 'Ketua Lab', 'email' => 'dipshey@polinema.ac.id', 'ruang' => 'Ruang Dosen 3', 'linkedin' => '#', 'github' => '#'],
                            ['nama' => 'Ketiwav Goreng', 'nip' => '123456789876', 'jabatan' => 'Ketua Lab', 'email' => 'dipshey@polinema.ac.id', 'ruang' => 'Ruang Dosen 3', 'linkedin' => '#', 'github' => '#'],
                            ['nama' => 'Ketiwav Goreng', 'nip' => '123456789876', 'jabatan' => 'Ketua Lab', 'email' => 'dipshey@polinema.ac.id', 'ruang' => 'Ruang Dosen 3', 'linkedin' => '#', 'github' => '#'],
                            ['nama' => 'Ketiwav Goreng', 'nip' => '123456789876', 'jabatan' => 'Ketua Lab', 'email' => 'dipshey@polinema.ac.id', 'ruang' => 'Ruang Dosen 3', 'linkedin' => '#', 'github' => '#'],
                            ['nama' => 'Ketiwav Goreng', 'nip' => '123456789876', 'jabatan' => 'Ketua Lab', 'email' => 'dipshey@polinema.ac.id', 'ruang' => 'Ruang Dosen 3', 'linkedin' => '#', 'github' => '#'],
                            ['nama' => 'Ketiwav Goreng', 'nip' => '123456789876', 'jabatan' => 'Ketua Lab', 'email' => 'dipshey@polinema.ac.id', 'ruang' => 'Ruang Dosen 3', 'linkedin' => '#', 'github' => '#'],
                        ];

                        foreach ($personilData as $index => $person) {
                            echo '<tr>';
                            echo '<td>' . $person['nama'] . '</td>';
                            echo '<td>' . $person['nip'] . '</td>';
                            echo '<td>' . $person['jabatan'] . '</td>';
                            echo '<td>' . $person['email'] . '</td>';
                            echo '<td>' . $person['ruang'] . '</td>';
                            // Kode BARU
                            echo '<td>';
                            echo '<a href="' . $person['linkedin'] . '" class="btn-social me-1" target="_blank"><i class="bi bi-linkedin"></i></a>';
                            echo '<a href="' . $person['github'] . '" class="btn-social" target="_blank"><i class="bi bi-github"></i></a>'; // <-- Sudah diganti
                            echo '</td>';
                            echo '<td>';
                            echo '<button class="btn border-0 bg-transparent p-0 me-2" data-bs-toggle="modal" data-bs-target="#personilModal" onclick="editPersonil(' . $index . ')"><i class="bi bi-pencil-square text-primary fs-4"></i></button>';
                            echo '<button class="btn border-0 bg-transparent p-0" onclick="deletePersonil(' . $index . ')"><i class="bi bi-trash text-danger fs-4"></i></button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
            <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                    <ul class="pagination"> <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
                </div>
        </div>
    </div>
    
    <?php include 'personilModals.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sample data for demonstration
        const personilData = [
            {nama: 'Ketiwav Goreng', nip: '123456789876', jabatan: 'Ketua Lab', email: 'dipshey@polinema.ac.id', ruang: 'Ruang Dosen 3', linkedin: '#', github: '#'},
            {nama: 'Ketiwav Goreng', nip: '123456789876', jabatan: 'Ketua Lab', email: 'dipshey@polinema.ac.id', ruang: 'Ruang Dosen 3', linkedin: '#', github: '#'},
        ];

        function resetForm() {
            document.getElementById('personilModalLabel').textContent = 'Data Dosen';
            document.getElementById('personil-nama').value = '';
            document.getElementById('personil-nip').value = '';
            document.getElementById('personil-jabatan').value = '';
            document.getElementById('personil-email').value = '';
            document.getElementById('personil-ruang').value = '';
            document.getElementById('personil-github').value = '';
            document.getElementById('personil-linkedin').value = '';
            document.getElementById('personil-id').value = '';
        }

        function editPersonil(index) {
            const person = personilData[index];
            document.getElementById('personilModalLabel').textContent = 'Edit Data Dosen';
            document.getElementById('personil-nama').value = person.nama;
            document.getElementById('personil-nip').value = person.nip;
            document.getElementById('personil-jabatan').value = person.jabatan;
            document.getElementById('personil-email').value = person.email;
            document.getElementById('personil-ruang').value = person.ruang;
            document.getElementById('personil-github').value = person.github;
            document.getElementById('personil-linkedin').value = person.linkedin;
            document.getElementById('personil-id').value = index;
        }

        function deletePersonil(index) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                console.log('Delete personil at index:', index);
                // Add delete logic here
            }
        }

        // Form submit handler
        document.getElementById('savePersonilBtn').addEventListener('click', function() {
            const formData = {
                id: document.getElementById('personil-id').value,
                nama: document.getElementById('personil-nama').value,
                nip: document.getElementById('personil-nip').value,
                jabatan: document.getElementById('personil-jabatan').value,
                email: document.getElementById('personil-email').value,
                ruang: document.getElementById('personil-ruang').value,
                github: document.getElementById('personil-github').value,
                linkedin: document.getElementById('personil-linkedin').value
            };
            
            console.log('Form data:', formData);
            // Add save logic here (AJAX call to backend)
            
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('personilModal'));
            modal.hide();
        });
    </script>
</body>
</html>