<?php 
// File: /Views/personil_admin/penelitian.php (Asumsi nama file disesuaikan)

// 1. Definisikan Title dan CSS
$title = "Pengelolaan Penelitian Dosen: " . htmlspecialchars($nama_dosen);

// CSS tetap sama karena styling sudah baik
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

/* TABLE */
.table th {
    color: #6b7280;
    font-size: 14px;
    font-weight: 600;
}

/* ACTION ICON */
.action-icon {
    font-size: 18px;
    cursor: pointer;
    margin-right: 10px;
}
.action-icon.edit { color: #3B82F6; }
.action-icon.delete { color: #EF4444; }
.action-icon.link { color: #28a745; }


/* BUTTON */
.btn-tambah {
    background-color: #06315A;
    color: white;
    font-weight: 500;
    border-radius: 8px;
    padding: 8px 18px;
}
"; 
include_once __DIR__ . '/../admin/layout/header.php';
// Diasumsikan variabel $personil_id, $nama_dosen, dan $penelitian sudah didefinisikan di Controller
?>

<div class="d-flex min-vh-100">
    <?= include __DIR__ . '/../admin/layout/sidebar.php'; ?>

    <div class="main-content flex-grow-1">

        <div class="page-header d-flex justify-content-between align-items-center">
            <h2 class="fw-bold fs-3 mb-0">
                <i class="bi bi-search"></i> Penelitian Dosen: <?= htmlspecialchars($nama_dosen) ?>
            </h2>

        <button class="btn-tambah btnTambahPenelitian" data-personil-id="<?= $personil_id ?>" onclick="openHkiModal()">
            <i class="bi bi-plus-lg"></i> Tambahkan HKI
        </button>
        </div>

        <div class="page-content">

            <?php 
            // Cek apakah data Penelitian kosong.
            if (empty($hki)): 
            ?>
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle"></i> Belum ada data penelitian untuk dosen ini.
                </div>
            <?php else: ?>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul HKI</th>
                                <th>Jenis HKI</th>
                                <th>No. PDD/Kontrak</th>
                                <th>Tahun</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; foreach ($hki as $row): 
                            // Mengambil data sesuai skema baru: id_penelitian, judul, jenis, no_pdd, tahun, link (opsional)
                            $id_hki = htmlspecialchars($row['id_hki'] ?? '');
                            $judul = htmlspecialchars($row['judul'] ?? '-');
                            $jenis = htmlspecialchars($row['jenis'] ?? '-'); // DATA BARU
                            $no_pdd = htmlspecialchars($row['no_pdd'] ?? '-'); // DATA BARU
                            $tahun = htmlspecialchars($row['tahun'] ?? '-');
                            $link = htmlspecialchars($row['link'] ?? ''); // Link tetap dipertahankan jika ada di data
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $judul ?></td>
                                <td><?= $jenis ?></td> <td><?= $no_pdd ?></td> <td><?= $tahun ?></td>
                                <td>
                                    <?php if (!empty($link)): ?>
                                        <a href="<?= $link ?>" target="_blank" title="Lihat Link">
                                            <i class="bi bi-link-45deg action-icon link"></i>
                                        </a>
                                    <?php endif; ?>
<i class="bi bi-pencil-square action-icon edit btnEditPenelitian"
   data-id="<?= $row['id_hki'] ?>" data-personil-id="<?= $personil_id ?>"
   title="Edit HKI" onclick="openHkiModal(<?= $row['id_hki'] ?>)"></i>
                                        <i class="bi bi-trash-fill action-icon delete"
                                           data-id="<?= $row['id_hki'] ?>" data-personil-id="<?= $personil_id ?>"
                                           title="Hapus HKI" onclick="deleteHki(<?= $row['id_hki'] ?>)"></i>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        Menampilkan semua data. Total: <?= count($penelitian); ?> penelitian.
                    </small>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- Modal for Add/Update HKI -->
<div class="modal fade" id="hkiModal" tabindex="-1" aria-labelledby="hkiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hkiModalLabel">Tambah/Update HKI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="hkiForm">
                    <input type="hidden" name="id_hki" id="id_hki">
                    <div class="mb-3">
                        <label for="judul_hki" class="form-label">Judul HKI</label>
                        <input type="text" class="form-control" name="judul_hki" id="judul_hki" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_hki" class="form-label">Jenis HKI</label>
                        <input type="text" class="form-control" name="jenis_hki" id="jenis_hki" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_pdd_hki" class="form-label">No. PDD/Kontrak</label>
                        <input type="text" class="form-control" name="no_pdd_hki" id="no_pdd_hki" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_hki" class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun_hki" id="tahun_hki" required>
                    </div>
                    <div class="mb-3">
                        <label for="link_hki" class="form-label">Link</label>
                        <input type="url" class="form-control" name="link_hki" id="link_hki">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
 // Function to open the modal for both Add and Edit actions
    function openHkiModal(id = null) {
        if (id) {
            // If there's an id, this means the user wants to edit an existing HKI
            $.ajax({
                url: '/admin/index.php?action=hki&id_hki=' + id,  // Ensure this URL is correct
                method: 'GET',
                success: function(data) {
                    const hki = JSON.parse(data);
                    $('#id_hki').val(hki.id_hki);
                    $('#judul_hki').val(hki.judul_hki);
                    $('#jenis_hki').val(hki.jenis_hki);
                    $('#no_pdd_hki').val(hki.no_pdd_hki);
                    $('#tahun_hki').val(hki.tahun_hki);
                    $('#link_hki').val(hki.link_hki);
                    $('#hkiModalLabel').text('Edit HKI');
                    $('#hkiModal').modal('show');  // Open the modal
                }
            });
        } else {
            // If there's no id, this means the user wants to add a new HKI
            $('#hkiForm')[0].reset();  // Reset the form fields
            $('#hkiModalLabel').text('Tambah HKI');  // Set modal title to "Add"
            $('#hkiModal').modal('show');  // Open the modal
        }
    }

    // Handle the form submission
    $('#hkiForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();  // Serialize form data

        $.ajax({
            url: '/admin/index.php?action=Dosenhki',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('HKI berhasil disimpan!');
                $('#hkiModal').modal('hide');
                location.reload();  // Refresh the page to update the data
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Check the error response in console
            }
        });
    });

    // Delete HKI functionality
    function deleteHki(id) {
        if (confirm('Are you sure you want to delete this HKI?')) {
            $.ajax({
                url: '/admin/index.php?action=Dosenhki&delete=true&id_hki=' + id,  // Ensure the URL is correct
                method: 'POST',
                success: function(response) {
                    alert('HKI deleted successfully!');
                    location.reload();  // Refresh the page after deleting
                }
            });
        }
    }

</script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (with Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>