<?php 
// File: /Views/personil_admin/buku.php (Asumsi nama file disesuaikan)

// 1. Definisikan Title dan CSS
// Title diubah menjadi Pengelolaan Buku Dosen
$title = "Buku Referensi Dosen: " . htmlspecialchars($nama_dosen);

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
// Diasumsikan variabel $personil_id, $nama_dosen, dan $buku sudah didefinisikan di Controller
// Mengganti variabel data dari $penelitian menjadi $buku
?>

<!-- MODALS -->
 <!-- Modal Tambah / Edit Buku -->
<div class="modal fade" id="modalBuku" tabindex="-1" aria-labelledby="modalBukuLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="/admin/index.php?action=karya_buku" method="POST">
        <input type="hidden" name="action" value="karya_buku">
        <div class="modal-header">
          <h5 class="modal-title" id="modalBukuLabel">Tambah Buku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_buku" id="buku-id">
          <input type="hidden" name="personil_id" value="<?= $personil_id ?>">

          <div class="mb-3">
            <label for="judul_buku" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
          </div>

          <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" required>
          </div>

          <div class="mb-3">
            <label for="halaman" class="form-label">Halaman</label>
            <input type="number" class="form-control" id="halaman" name="halaman" required>
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
          <button type="submit" class="btn btn-primary" name="submitKaryaBuku">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- CONTENT -->
<div class="d-flex min-vh-100">
    <?= include __DIR__ . '/../admin/layout/sidebar.php';
?>

    <div class="main-content flex-grow-1">

        <div class="page-header d-flex justify-content-between align-items-center">
            <h2 class="fw-bold fs-3 mb-0">
                <i class="bi bi-book-half"></i> Buku/Buku Referensi Dosen: <?= htmlspecialchars($nama_dosen) ?>
            </h2>

            <button class="btn-tambah btnTambahBuku" data-personil-id="<?= $personil_id ?>">
                <i class="bi bi-plus-lg"></i> Tambahkan Buku
            </button>
        </div>

        <div class="page-content">

            <?php 
            // Cek apakah data Buku kosong. Menggunakan variabel $buku
            if (empty($buku)): 
            ?>
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle"></i> Belum ada data buku/referensi untuk dosen ini.
                </div>
            <?php else: ?>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Penerbit</th>
                                <th>Halaman</th>
                                <th>Tahun</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; foreach ($buku as $row): 
                            // Mengambil data sesuai skema: id_buku, judul, penerbit, halaman, tahun, link
                            $id_buku = htmlspecialchars($row['id_buku'] ?? '');
                            $judul = htmlspecialchars($row['judul'] ?? '-');
                            $penerbit = htmlspecialchars($row['penerbit'] ?? '-');
                            $halaman = htmlspecialchars($row['halaman'] ?? '-');
                            $tahun = htmlspecialchars($row['tahun'] ?? '-');
                            $link = htmlspecialchars($row['link'] ?? '');
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $judul ?></td>
                                <td><?= $penerbit ?></td>
                                <td><?= $halaman ?></td>
                                <td><?= $tahun ?></td>
                                <td>
                                    <?php if (!empty($link)): ?>
                                        <a href="<?= $link ?>" target="_blank" title="Lihat Link Buku">
                                            <i class="bi bi-link-45deg action-icon link"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <i 
                                        class="bi bi-pencil-square action-icon edit btnEditBuku" 
                                        data-id="<?= $id_buku ?>"
                                        data-personil-id="<?= $personil_id ?>"
                                        data-judul="<?= $judul ?>"
                                        data-penerbit="<?= $penerbit ?>"
                                        data-halaman="<?= $halaman ?>"
                                        data-tahun="<?= $tahun ?>"
                                        data-link="<?= $link ?>"
                                        title="Edit Buku"
                                    ></i>
                                    <form action="/admin/index.php?action=deleteKaryaBuku" method="POST" style="display:inline;">
                                        <input type="hidden" name="action" value="deleteKaryaBuku">
                                        <input type="hidden" name="id_buku" value="<?= $id_buku ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Buku" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
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
                        Menampilkan semua data. Total: <?= count($buku); ?> buku/referensi.
                    </small>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('modalBuku'));

    // Tombol tambah
    document.querySelector('.btnTambahBuku').addEventListener('click', function() {
        document.getElementById('modalBukuLabel').textContent = 'Tambah Buku';
        document.getElementById('buku-id').value = '';
        document.getElementById('judul_buku').value = '';
        document.getElementById('penerbit').value = '';
        document.getElementById('halaman').value = '';
        document.getElementById('tahun').value = '';
        document.getElementById('link').value = '';
        modal.show();
    });

    // Tombol edit
    document.querySelectorAll('.btnEditBuku').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const personil_id = this.dataset.personilId;

            // Ambil data dari tabel (atau bisa dari attribute data-* tambahan)
            const row = this.closest('tr');
            document.getElementById('modalBukuLabel').textContent = 'Edit Buku';
            document.getElementById('buku-id').value = id;
            document.getElementById('judul_buku').value = row.cells[1].innerText;
            document.getElementById('penerbit').value = row.cells[2].innerText !== '-' ? row.cells[2].innerText : '';
            document.getElementById('halaman').value = row.cells[3].innerText !== '-' ? row.cells[3].innerText : '';
            document.getElementById('tahun').value = row.cells[4].innerText;
            // link bisa ambil dari anchor tag
            const linkTag = row.cells[1].querySelector('a');
            document.getElementById('link').value = linkTag ? linkTag.href : '';

            modal.show();
        });
    });
    document.querySelectorAll('.btnHapusBuku').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const personil_id = this.dataset.personilId;

            // Konfirmasi hapus
            if (!confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                return;
            }

            // Kirim permintaan hapus ke server
            fetch('/admin/index.php?action=deletePengabdian', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'id_buku': id,
                    'personil_id': personil_id,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Buku berhasil dihapus.');
                    location.reload(); 
                } else {
                    alert('Gagal menghapus buku.');
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan: ' + error);
            });
        });
    });
});

</script>
