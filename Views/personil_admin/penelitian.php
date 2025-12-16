<?php
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
include_once __DIR__ . '/../layout/header.php';
?>

<div class="d-flex min-vh-100">
    <?= include __DIR__ . '/../admin/layout/sidebar.php'; ?>
<!-- Modal Tambah / Edit Penelitian -->
<div class="modal fade" id="modalPenelitian" tabindex="-1" aria-labelledby="modalPenelitianLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="/admin/index.php?action=penelitian" method="POST">
        <input type="hidden" name="action" value="penelitian">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPenelitianLabel">Tambah Penelitian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_penelitian" id="penelitian-id">
          <input type="hidden" name="personil_id" value="<?= $personil_id ?>">

          <div class="mb-3">
            <label for="judul_penelitian" class="form-label">Judul Penelitian</label>
            <input type="text" class="form-control" id="judul_penelitian" name="judul_penelitian" required>
          </div>

          <div class="mb-3">
            <label for="sumber_dana" class="form-label">Sumber Dana</label>
            <input type="text" class="form-control" id="sumber_dana" name="sumber_dana">
          </div>

          <div class="mb-3">
            <label for="jml_dana" class="form-label">Jumlah Dana (Rp)</label>
            <input type="number" class="form-control" id="jml_dana" name="jml_dana">
          </div>

          <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" required>
          </div>

          <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="url" class="form-control" id="link" name="link">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" name="submitPenelitian">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- CONTENT -->
    <div class="main-content flex-grow-1">

        <div class="page-header d-flex justify-content-between align-items-center">
            <h2 class="fw-bold fs-3 mb-0">
                <i class="bi bi-person-fill"></i> Penelitian Dosen: <?= htmlspecialchars($nama_dosen) ?>
            </h2>

            <button class="btn-tambah btnTambahPenelitian" data-personil-id="<?= $personil_id ?>">
                <i class="bi bi-plus-lg"></i> Tambahkan Penelitian
            </button>
        </div>

        <div class="page-content">

            <?php if (empty($penelitian)): ?>
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle"></i> Belum ada data penelitian untuk dosen ini.
                </div>
            <?php else: ?>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Penelitian</th>
                                <th>Sumber Dana</th>
                                <th>Jumlah Dana</th>
                                <th>Tahun</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; foreach ($penelitian as $row): 
                            $id_penelitian = htmlspecialchars($row['id_penelitian']);
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['judul_penelitian']) ?></td>
                                <td><?= htmlspecialchars($row['sumber_dana'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($row['jml_dana'] ? 'Rp. ' . number_format($row['jml_dana'], 0, ',', '.') : '-') ?></td>
                                <td><?= htmlspecialchars($row['tahun']) ?></td>
                                <td>
                                    <?php if (!empty($row['link'])): ?>
                                        <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" title="Lihat Link">
                                            <i class="bi bi-link-45deg action-icon link"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <i 
                                        class="bi bi-pencil-square action-icon edit btnEditPenelitian" 
                                        data-id="<?= $id_penelitian ?>"
                                        data-personil-id="<?= $personil_id ?>"
                                        title="Edit Penelitian"
                                    ></i>
                                    <i 
                                        class="bi bi-trash-fill action-icon delete btnHapusPenelitian" 
                                        data-id="<?= $id_penelitian ?>"
                                        data-personil-id="<?= $personil_id ?>"
                                        title="Hapus Penelitian"
                                    ></i>

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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('modalPenelitian'));

    // Tombol tambah
    document.querySelector('.btnTambahPenelitian').addEventListener('click', function() {
        document.getElementById('modalPenelitianLabel').textContent = 'Tambah Penelitian';
        document.getElementById('penelitian-id').value = '';
        document.getElementById('judul_penelitian').value = '';
        document.getElementById('sumber_dana').value = '';
        document.getElementById('jml_dana').value = '';
        document.getElementById('tahun').value = '';
        document.getElementById('link').value = '';
        modal.show();
    });

    // Tombol edit
    document.querySelectorAll('.btnEditPenelitian').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const personil_id = this.dataset.personilId;

            // Ambil data dari tabel (atau bisa dari attribute data-* tambahan)
            const row = this.closest('tr');
            document.getElementById('modalPenelitianLabel').textContent = 'Edit Penelitian';
            document.getElementById('penelitian-id').value = id;
            document.getElementById('judul_penelitian').value = row.cells[1].innerText;
            document.getElementById('sumber_dana').value = row.cells[2].innerText !== '-' ? row.cells[2].innerText : '';
            document.getElementById('jml_dana').value = (parseInt(row.cells[3].innerText.replace(/[^0-9]/g,'')) || 0);
            document.getElementById('tahun').value = row.cells[4].innerText;
            // link bisa ambil dari anchor tag
            const linkTag = row.cells[1].querySelector('a');
            document.getElementById('link').value = linkTag ? linkTag.href : '';

            modal.show();
        });
    });
    document.querySelectorAll('.btnHapusPenelitian').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const personil_id = this.dataset.personilId;

            // Konfirmasi hapus
            if (!confirm('Apakah Anda yakin ingin menghapus penelitian ini?')) {
                return;
            }

            // Kirim permintaan hapus ke server
            fetch('/admin/index.php?action=deletePenelitian', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'id_penelitian': id,
                    'personil_id': personil_id,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Refresh halaman atau hapus baris dari tabel
                    location.reload(); // Reload to reflect changes
                } else {
                    alert('Gagal menghapus penelitian.');
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan: ' + error);
            });
        });
    });
});

</script>
