<?php
session_start();

$title = "Dashboard Admin";

require_once __DIR__ . "/../../Core/Database.php";
require_once __DIR__ . "/../../Models/MahasiswaModel.php"; 
require_once __DIR__ . "/../../Models/aboutModel.php";

$Model = new AboutModel();
$userModel = new ModelMahasiswa();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve'])) {
        $id = intval($_POST['approve']);
        $userModel->approveMahasiswa($id);
    } elseif (isset($_POST['delete'])) {
        $id = intval($_POST['delete']);
        $userModel->deleteMahasiswa($id);
    }
    // Refresh halaman setelah aksi
    header("Location: home.php");
    // exit;
}


$visi = $Model->getVisi();
$misi = $Model->getMisi();
$tentang = $Model->getTentang();
$mahasiswaMenunggu = $userModel->getMahasiswaMenunggu();
$mahasiswaDisetujui = $userModel->getMahssiswaSetujui();

require_once __DIR__ . "/../layout/header.php";

?>


<div class="container py-5">
    <h2 class="fw-bold mb-4">Dashboard Admin</h2>
    <!-- <p class="text-muted">Selamat datang, <strong><?= htmlspecialchars($user['username']); ?></strong>.</p> -->

 <!-- Tentang Lab -->
    <div class="card shadow-sm border-0 rounded-4 mb-4 p-4 position-relative">
        <h4 class="fw-semibold mb-3 d-flex justify-content-between align-items-center">
            Tentang Lab
            <button name="editAbout" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editAboutModal">
                Edit
            </button>
        </h4>
        <p class="text-muted"><?= nl2br(htmlspecialchars($tentang)) ?></p>
    </div>

    <!-- Visi dan Misi -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4">
<h4 class="fw-semibold mb-3 d-flex justify-content-between align-items-center">
                    Visi
                    <button name="editVisi" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editAboutModal">
                         Edit
                    </button>
                </h4>
                <p class="text-muted mb-0"><?= nl2br(htmlspecialchars($visi)) ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-semibold mb-3">Misi</h4>
                <ul class="text-muted mb-0">
                    <?php if (is_array($misi)): ?>
                        <?php foreach ($misi as $item): ?>
                            <li><?= htmlspecialchars($item) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><?= htmlspecialchars($misi) ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Mahasiswa Menunggu -->
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h4 class="fw-semibold mb-3">Mahasiswa Menunggu Persetujuan</h4>

        <?php if (empty($mahasiswaMenunggu)): ?>
            <div class="alert alert-info mb-0">Tidak ada mahasiswa yang menunggu persetujuan.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswaMenunggu as $index => $mhs): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($mhs['nama']) ?></td>
                                <td><?= htmlspecialchars($mhs['nim']) ?></td>
                                <td><?= htmlspecialchars($mhs['prodi']) ?></td>
                                <td><?= htmlspecialchars($mhs['angkatan']) ?></td>
                                <td><span class="badge bg-warning text-dark"><?= htmlspecialchars($mhs['status']) ?></span></td>
                                <td class="text-center">
                                    <form method="POST" style="display:inline-block;">
                                        <button 
                                            type="submit" 
                                            name="approve" 
                                            value="<?= $mhs['id'] ?>" 
                                            class="btn btn-success btn-sm me-2">
                                            Setujui
                                        </button>
                                    </form>

                                    <form method="POST" style="display:inline-block;">
                                        <button 
                                            type="submit" 
                                            name="delete" 
                                            value="<?= $mhs['id'] ?>" 
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus mahasiswa ini?');">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
     <div class="card shadow-sm border-0 rounded-4 p-4">
        <h4 class="fw-semibold mb-3">Mahasiswa yang Disetujui</h4>

        <?php if (empty($mahasiswaDisetujui)): ?>
            <div class="alert alert-secondary mb-0">Belum ada mahasiswa yang disetujui.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswaDisetujui as $index => $mhs): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($mhs['nama']) ?></td>
                                <td><?= htmlspecialchars($mhs['nim']) ?></td>
                                <td><?= htmlspecialchars($mhs['prodi']) ?></td>
                                <td><?= htmlspecialchars($mhs['angkatan']) ?></td>
                                <td><span class="badge bg-success"><?= htmlspecialchars($mhs['status']) ?></span></td>
                                <td class="text-center">
                                    <form method="POST" style="display:inline-block;">
                                        <button 
                                            type="submit" 
                                            name="delete" 
                                            value="<?= $mhs['id'] ?>" 
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus mahasiswa ini?');">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>