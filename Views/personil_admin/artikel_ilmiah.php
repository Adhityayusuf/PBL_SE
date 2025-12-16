<?php 
// File: /Views/personil_admin/pengabdian.php

// 1. Definisikan Title dan CSS
$title = "Pengelolaan Portofolio Dosen: " . htmlspecialchars($nama_dosen);

// CSS tetap sama karena styling sudah baik, hanya menambahkan keterangan untuk class 'file'/'link'
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
.action-icon.link, .action-icon.file { color: #28a745; }


/* BUTTON */
.btn-tambah {
    background-color: #06315A;
    color: white;
    font-weight: 500;
    border-radius: 8px;
    padding: 8px 18px;
}
"; 
// Memuat layout dasar (Header dan Sidebar)
include_once __DIR__ . '/../layout/header.php';
// Diasumsikan variabel $personil_id, $nama_dosen, $artikel_ilmiah sudah didefinisikan
?>

<!-- MODALS -->
<div class="modal fade" id="modalArtikelIlmiah" tabindex="-1" aria-labelledby="modalArtikelIlmiahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="/admin/index.php?action=artikel_ilmiah" method="POST">
        <input type="hidden" name="action" value="artikel_ilmiah">
        <div class="modal-header">
          <h5 class="modal-title" id="modalArtikelIlmiahLabel">Tambah Artikel Ilmiah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_artikel" id="artikel-id">
          <input type="hidden" name="personil_id" value="<?= $personil_id ?>">

          <div class="mb-3">
            <label for="judul_artikel" class="form-label">Judul Artikel Ilmiah</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
          </div>

          <div class="mb-3">
            <label for="nama_jurnal" class="form-label">Nama Jurnal</label>
            <input type="text" class="form-control" id="nama_jurnal" name="nama_jurnal">
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
          <button type="submit" class="btn btn-primary" name="submitArtikelIlmiah">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- CONTENT -->
<div class="d-flex min-vh-100">
    <?= include __DIR__ . '/../admin/layout/sidebar.php'; ?>

    <div class="main-content flex-grow-1">

        <div class="page-header d-flex justify-content-between align-items-center mt-5">
            <h2 class="fw-bold fs-3 mb-0">
                <i class="bi bi-journal-text"></i> Artikel Ilmiah Dosen: <?= htmlspecialchars($nama_dosen) ?>
            </h2>
            
            <button class="btn-tambah btnTambahArtikel" data-personil-id="<?= $personil_id ?>">
                <i class="bi bi-plus-lg"></i> Tambahkan Artikel Ilmiah
            </button>
        </div>

        <div class="page-content">

            <?php 
            // Cek apakah data Artikel Ilmiah kosong. Menggunakan variabel $artikel_ilmiah
            if (empty($artikel)): 
            ?> 
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle"></i> Belum ada data artikel ilmiah untuk dosen ini.
                </div>
            <?php else: ?>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Artikel</th>
                                <th>Nama Jurnal</th>
                                <th>Tahun</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; 
                            foreach ($artikel as $row): 
                                // Mengambil data sesuai skema yang baru: judul, nama_jurnal, tahun, link
                                $id_artikel = htmlspecialchars($row['id_artikel'] ?? ''); 
                                $judul_artikel = htmlspecialchars($row['judul'] ?? '-'); 
                                $nama_jurnal = htmlspecialchars($row['nama_jurnal'] ?? '-'); 
                                $tahun = htmlspecialchars($row['tahun'] ?? '-'); 
                                $link = htmlspecialchars($row['link'] ?? '');
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $judul_artikel ?></td>
                                    <td><?= $nama_jurnal ?></td> 
                                    <td><?= $tahun ?></td>
                                    <td>
                                        <?php if (!empty($link)): ?>
                                            <a href="<?= $link ?>" target="_blank" title="Lihat Link Artikel">
                                                <i class="bi bi-link-45deg action-icon link"></i>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <i 
                                            class="bi bi-pencil-square action-icon edit btnEditArtikel" 
                                            data-id="<?= $id_artikel ?>"
                                            data-personil-id="<?= $personil_id ?>"
                                            title="Edit Artikel"
                                        ></i>
                                        <form action="/admin/index.php?action=deleteArtikelIlmiah" method="POST" style="display:inline;">
                                            <input type="hidden" name="action" value="deleteArtikelIlmiah">
                                            <input type="hidden" name="id_artikel" value="<?= $id_artikel ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Artikel">
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
                        Menampilkan semua data. Total: <?= count($artikel); ?> artikel ilmiah.
                    </small>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('modalArtikelIlmiah'));

    // Tombol tambah
    document.querySelector('.btnTambahArtikel').addEventListener('click', function() {
        document.getElementById('modalArtikelIlmiahLabel').textContent = 'Tambah Artikel Ilmiah';
        document.getElementById('artikel-id').value = '';
        document.getElementById('judul').value = '';
        document.getElementById('nama_jurnal').value = '';
        document.getElementById('tahun').value = '';
        document.getElementById('link').value = '';
        modal.show();
    });

    // Tombol edit
    document.querySelectorAll('.btnEditArtikel').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const personil_id = this.dataset.personilId;

            // Ambil data dari tabel (atau bisa dari attribute data-* tambahan)
            const row = this.closest('tr');
            document.getElementById('modalArtikelIlmiahLabel').textContent = 'Edit Artikel Ilmiah';
            document.getElementById('artikel-id').value = id;
            document.getElementById('judul').value = row.cells[1].innerText;
            document.getElementById('nama_jurnal').value = row.cells[2].innerText !== '-' ? row.cells[2].innerText : '';
            document.getElementById('tahun').value = row.cells[4].innerText;
            // link bisa ambil dari anchor tag
            const linkTag = row.cells[1].querySelector('a');
            document.getElementById('link').value = linkTag ? linkTag.href : '';

            modal.show();
        });
    });
    document.querySelectorAll('.btnHapusArtikel').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const personil_id = this.dataset.personilId;

            // Konfirmasi hapus
            if (!confirm('Apakah Anda yakin ingin menghapus artikel ilmiah ini?')) {
                return;
            }

            // Kirim permintaan hapus ke server
            fetch('/admin/index.php?action=deleteArtikel', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'id_artikel': id,
                    'personil_id': personil_id,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Refresh halaman atau hapus baris dari tabel
                    location.reload(); // Reload to reflect changes
                } else {
                    alert('Gagal menghapus artikel ilmiah.');
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan: ' + error);
            });
        });
    });
});

</script>
