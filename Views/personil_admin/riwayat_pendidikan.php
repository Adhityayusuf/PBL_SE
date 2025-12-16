<?php 
// File: /Views/personil_admin/pendidikan.php

// 1. Definisikan Title dan CSS
$title = "Pengelolaan Riwayat Pendidikan Dosen: " . htmlspecialchars($nama_dosen);

// CSS
$customCSS = "
body {
    background: #F5F5F7;
    overflow-x: hidden;
}

/* WRAPPER KANAN */
.main-content {
    padding: 40px;
    width: 100%;
    background-color: #F5F5F7;
}

/* HEADER */
.page-header {
    background: #ffffff;
    padding: 24px 32px;
    border-radius: 12px;
    margin-bottom: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,.04);
}

/* CONTENT */
.page-content {
    background: white;
    padding: 32px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,.04);
}

/* BUTTON */
.btn-tambah {
    background-color: #06315A;
    color: white;
    font-weight: 500;
    border-radius: 8px;
    padding: 8px 18px;
}

/* CARD UNTUK PENDIDIKAN */
.education-level {
    margin-bottom: 20px;
    padding: 15px;
    border-left: 5px solid #06315A;
    background-color: #f8f9fa;
    border-radius: 6px;
    display: flex;
    flex-direction: column;
}

.education-level h5 {
    color: #06315A;
    font-weight: 600;
    margin-bottom: 10px;
}

.detail-item {
    margin-bottom: 5px;
}

.detail-item strong {
    min-width: 120px;
    display: inline-block;
}

.btn-edit, .btn-delete {
    margin-top: 10px;
    width: 100px;
    font-size: 12px;
    padding: 5px;
}

"; 
include_once __DIR__ . '/../layout/header.php';
?>

<div class="d-flex min-vh-100">
    <?= include __DIR__ . '/../admin/layout/sidebar.php'; ?>

    <div class="main-content flex-grow-1">

        <div class="page-header d-flex justify-content-between align-items-center">
            <h2 class="fw-bold fs-3 mb-0">
                <i class="bi bi-mortarboard-fill"></i> Riwayat Pendidikan Formal: <?= htmlspecialchars($nama_dosen) ?>
            </h2>

            <button class="btn-tambah btnEditPendidikan" data-personil-id="<?= $personil_id ?>">
                <i class="bi bi-pencil-square"></i> Edit Riwayat Pendidikan
            </button>
        </div>

        <div class="page-content">

            <?php
            // Memeriksa apakah ada data riwayat pendidikan untuk dosen
            if (empty($pendidikan['sarjana']) && empty($pendidikan['magister']) && empty($pendidikan['doktor'])):
            ?>
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle"></i> Belum ada data riwayat pendidikan untuk dosen ini.
                </div>
            <?php else: ?>

                <div class="row">
                    <?php
                    // Menampilkan Sarjana jika ada data
                    if (!empty($pendidikan['sarjana'])): 
                        $sarjana = $pendidikan['sarjana'][0]; // Mengambil data pertama
                    ?>
                        <div class="col-md-12 col-lg-12 mb-4">
                            <div class="education-level">
                                <h5 class="mb-2">Sarjana (S1)</h5>
                                <div class="detail-item"><strong>Institusi:</strong> <?= htmlspecialchars($sarjana['institusi'] ?? '-') ?></div>
                                <div class="detail-item"><strong>Jurusan/Prodi:</strong> <?= htmlspecialchars($sarjana['jurusan'] ?? '-') ?></div>
                                <div class="detail-item"><strong>Tahun Lulus:</strong> <?= htmlspecialchars($sarjana['tahun_lulus'] ?? '-') ?></div>
                                
                                <!-- Tombol Edit untuk Sarjana -->
                                <button class="btn btn-primary btn-sm btn-edit" data-education="sarjana" data-id="<?= htmlspecialchars($sarjana['id'] ?? '0') ?>">
                                    Edit
                                </button>

                                <!-- Tombol Delete untuk Sarjana -->
                                <button class="btn btn-danger btn-sm btn-delete" data-education="sarjana" data-id="<?= htmlspecialchars($sarjana['id'] ?? '0') ?>">
                                    Delete
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    // Menampilkan Magister jika ada data
                    if (!empty($pendidikan['magister'])): 
                        $magister = $pendidikan['magister'][0]; // Mengambil data pertama
                    ?>
                        <div class="col-md-12 col-lg-12 mb-4">
                            <div class="education-level">
                                <h5 class="mb-2">Magister (S2)</h5>
                                <div class="detail-item"><strong>Institusi:</strong> <?= htmlspecialchars($magister['institusi'] ?? '-') ?></div>
                                <div class="detail-item"><strong>Jurusan/Prodi:</strong> <?= htmlspecialchars($magister['jurusan'] ?? '-') ?></div>
                                <div class="detail-item"><strong>Tahun Lulus:</strong> <?= htmlspecialchars($magister['tahun_lulus'] ?? '-') ?></div>

                                <!-- Tombol Edit untuk Magister -->
                                <button class="btn btn-primary btn-sm btn-edit" data-education="magister" data-id="<?= htmlspecialchars($magister['id'] ?? '0') ?>">
                                    Edit
                                </button>

                                <!-- Tombol Delete untuk Magister -->
                                <button class="btn btn-danger btn-sm btn-delete" data-education="magister" data-id="<?= htmlspecialchars($magister['id'] ?? '0') ?>">
                                    Delete
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    // Menampilkan Doktor jika ada data
                    if (!empty($pendidikan['doktor'])): 
                        $doktor = $pendidikan['doktor'][0]; // Mengambil data pertama
                    ?>
                        <div class="col-md-12 col-lg-12 mb-4">
                            <div class="education-level">
                                <h5 class="mb-2">Doktor (S3)</h5>
                                <div class="detail-item"><strong>Institusi:</strong> <?= htmlspecialchars($doktor['institusi'] ?? '-') ?></div>
                                <div class="detail-item"><strong>Jurusan/Prodi:</strong> <?= htmlspecialchars($doktor['jurusan'] ?? '-') ?></div>
                                <div class="detail-item"><strong>Tahun Lulus:</strong> <?= htmlspecialchars($doktor['tahun_lulus'] ?? '-') ?></div>

                                <!-- Tombol Edit untuk Doktor -->
                                <button class="btn btn-primary btn-sm btn-edit" data-education="doktor" data-id="<?= htmlspecialchars($doktor['id'] ?? '0') ?>">
                                    Edit
                                </button>

                                <!-- Tombol Delete untuk Doktor -->
                                <button class="btn btn-danger btn-sm btn-delete" data-education="doktor" data-id="<?= htmlspecialchars($doktor['id'] ?? '0') ?>">
                                    Delete
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        Riwayat Pendidikan Formal untuk dosen: <?= htmlspecialchars($nama_dosen) ?>.
                    </small>
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>

<!-- JavaScript untuk menangani klik tombol Edit dan Delete -->
<script>
    // Tombol Edit
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const educationType = this.getAttribute('data-education'); // jenis pendidikan (sarjana, magister, doktor)
            const educationId = this.getAttribute('data-id'); // ID pendidikan yang akan diedit
            
            // Redirect ke halaman edit pendidikan
            window.location.href = `/admin/edit-education.php?education_type=${educationType}&id=${educationId}`;
        });
    });

    // Tombol Delete
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const educationType = this.getAttribute('data-education');
            const educationId = this.getAttribute('data-id');
            
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                // Redirect untuk menghapus data pendidikan
                window.location.href = `/admin/delete-education.php?education_type=${educationType}&id=${educationId}`;
            }
        });
    });
</script>
