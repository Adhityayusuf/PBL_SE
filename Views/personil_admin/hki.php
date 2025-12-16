<?php 
// File: /Views/personil_admin/penelitian.php

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

<!-- MODEL -->
<!-- Modal Tambah / Edit Penelitian -->
<div class="modal fade" id="modalHKI" tabindex="-1" aria-labelledby="modalHKILabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="/admin/index.php?action=hki" method="POST" id="hkiForm">
        <input type="hidden" name="action" value="hki">
        <input type="hidden" name="id_hki" id="hki-id">
        <input type="hidden" name="personil_id" value="<?= $personil_id ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="modalHKILabel">Tambah HKI</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="judul_hki" class="form-label">Judul HKI</label>
            <input type="text" class="form-control" id="judul_hki" name="judul_hki" required>
          </div>

          <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <input type="text" class="form-control" id="jenis" name="jenis" required>
          </div>

          <div class="mb-3">
            <label for="no_pdd" class="form-label">No PDD</label>
            <input type="number" class="form-control" id="no_pdd" name="no_pdd" required>
          </div>

          <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- CONTENT -->

<div class="d-flex min-vh-100">
    <?= include __DIR__ . '/../admin/layout/sidebar.php'; ?>

    <div class="main-content flex-grow-1">

        <div class="page-header d-flex justify-content-between align-items-center">
            <h2 class="fw-bold fs-3 mb-0">
                <i class="bi bi-search"></i> Penelitian Dosen: <?= htmlspecialchars($nama_dosen) ?>
            </h2>

            <button class="btn-tambah" data-bs-toggle="modal" data-bs-target="#modalHKI" data-action="add">
                <i class="bi bi-plus-lg"></i> Tambahkan HKI
            </button>
        </div>

        <div class="page-content">

            <?php 
            // Cek apakah data Penelitian kosong.
            if (empty($hki)): 
            ?>
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle"></i> Belum ada data HKI untuk dosen ini.
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
                            $id_hki = htmlspecialchars($row['id_hki'] ?? '');
                            $judul = htmlspecialchars($row['judul'] ?? '-');
                            $jenis = htmlspecialchars($row['jenis'] ?? '-');
                            $no_pdd = htmlspecialchars($row['no_pdd'] ?? '-');
                            $tahun = htmlspecialchars($row['tahun'] ?? '-');
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $judul ?></td>
                                <td><?= $jenis ?></td>
                                <td><?= $no_pdd ?></td>
                                <td><?= $tahun ?></td>
                                <td>
                                    <i class="bi bi-pencil-square action-icon edit" 
                                       data-bs-toggle="modal" 
                                       data-bs-target="#modalHKI" 
                                       data-action="edit"
                                       data-id="<?= $id_hki ?>" 
                                       data-judul="<?= $judul ?>" 
                                       data-jenis="<?= $jenis ?>" 
                                       data-no_pdd="<?= $no_pdd ?>" 
                                       data-tahun="<?= $tahun ?>"
                                       title="Edit HKI"></i>

                                    <form action="/admin/index.php?action=deleteHKI" method="POST" style="display:inline;">
                                        <input type="hidden" name="action" value="deleteHKI">
                                        <input type="hidden" name="id_hki" value="<?= $id_hki ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus HKI" onclick="return confirm('Apakah Anda yakin ingin menghapus HKI ini?');">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        Menampilkan semua data. Total: <?= count($hki); ?> HKI.
                    </small>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mengambil semua tombol edit dan hapus
    document.querySelectorAll('.action-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const action = this.dataset.action; // "edit" atau "delete"
            const form = document.getElementById('hkiForm');
            const modalLabel = document.getElementById('modalHKILabel');

            if (action === 'edit') {
                // Isi form dengan data yang sudah ada di tabel
                form.action = '/admin/index.php?action=edit_hki'; // Endpoint untuk edit
                modalLabel.textContent = 'Edit HKI';
                document.getElementById('hki-id').value = this.dataset.id;
                document.getElementById('judul_hki').value = this.dataset.judul;
                document.getElementById('jenis').value = this.dataset.jenis;
                document.getElementById('no_pdd').value = this.dataset.no_pdd;
                document.getElementById('tahun').value = this.dataset.tahun;
            } else if (action === 'delete') {
                // Konfirmasi hapus dengan alert
                if (confirm('Apakah Anda yakin ingin menghapus HKI ini?')) {
                    // Kirim permintaan hapus ke server
                    fetch('/admin/index.php?action=deleteHKI', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            'id_hki': this.dataset.id,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('HKI berhasil dihapus.');
                        } else {
                            alert('Gagal menghapus HKI.');
                        }
                    })
                }
            }
        });
    });
});
</script>

</body>
</html>