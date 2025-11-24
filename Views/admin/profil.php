<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Profil Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        /*konten admin*/
        body {
            background-color: #f8f9fa; 
        }
        .main-content {
            padding: 30px;
            width: calc(100% - 270px);
        }
        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 10px;
        }
        .scope-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .scope-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="d-flex">
    <?php 
    include '../layout/sidebar.php'; 
    ?>
        <div class="main-content">
            <h3 class="fw-bold mb-4">Pengelolaan Profil Lab</h3>
            <hr class="mt-0 mb-4">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title fw-bold">Tentang Lab</h5>
                            <p class="card-text text-muted">Lab Software Engineering merupakan salah satu laboratorium di bawah Jurusan Teknologi Informasi, Politeknik Negeri Malang.</p>
                        </div>
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTentangLabModal">Edit</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title fw-bold">Visi</h5>
                            <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                        </div>
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editVisiMisiModal" data-type="Visi">Edit</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title fw-bold">Misi</h5>
                            <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                        </div>
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editVisiMisiModal" data-type="Misi">Edit</button>
                    </div>
                </div>
            </div>

            <div class="card" style="max-width: 700px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Scope dan Focus Lab</h5>
                    
                    <div class="scope-item">
                        <span>Web Development</span>
                        <div>
                            <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editScopeModal" data-name="Web Development">Edit</button>
                            <button class="btn btn-outline-danger btn-sm">Hapus</button>
                        </div>
                    </div>

                    <div class="scope-item">
                        <span>Mobile Development</span>
                        <div>
                            <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editScopeModal" data-name="Mobile Development">Edit</button>
                            <button class="btn btn-outline-danger btn-sm">Hapus</button>
                        </div>
                    </div>
                    
                    <div class="scope-item">
                        <span>Software Testing & Quality Assurance</span>
                        <div>
                            <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editScopeModal" data-name="Software Testing & Quality Assurance">Edit</button>
                            <button class="btn btn-outline-danger btn-sm">Hapus</button>
                        </div>
                    </div>
                    
                    <div class="scope-item">
                        <span>Software Development Process & Methodology</span>
                        <div>
                            <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editScopeModal" data-name="Software Development Process & Methodology">Edit</button>
                            <button class="btn btn-outline-danger btn-sm">Hapus</button>
                        </div>
                    </div>

                    <a href="#" class="btn btn-link mt-3 p-0" data-bs-toggle="modal" data-bs-target="#editScopeModal" data-name="Tambah Focus">Tambah Focus</a>
                </div>
            </div>
        </div>
        </div>
    
    <?php include 'profilModals.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>