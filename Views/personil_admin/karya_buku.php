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

<div class="d-flex min-vh-100">
    <?= include __DIR__ . '/../admin/layout/sidebar.php'; include __DIR__ . '/bukuModals.php';
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
                                    <i 
                                        class="bi bi-trash-fill action-icon delete btnHapusBuku" 
                                        data-id="<?= $id_buku ?>"
                                        data-personil-id="<?= $personil_id ?>"
                                        title="Hapus Buku"
                                    ></i>

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
  const bukuModalEl = document.getElementById('bukuModal');
  const hapusModalEl = document.getElementById('hapusBukuModal');

  // Helper: reset form
  function resetBukuForm() {
    document.getElementById('bukuId').value = '';
    document.getElementById('bukuJudul').value = '';
    document.getElementById('bukuPenerbit').value = '';
    document.getElementById('bukuHalaman').value = '';
    document.getElementById('bukuTahun').value = '';
    document.getElementById('bukuLink').value = '';
  }

  // Klik "Tambahkan Buku"
  document.querySelectorAll('.btnTambahBuku').forEach(btn => {
    btn.addEventListener('click', () => {
      const personilId = btn.getAttribute('data-personil-id') || '';
      document.getElementById('bukuPersonilId').value = personilId;

      document.getElementById('bukuModalTitle').textContent = 'Tambah Buku';
      document.getElementById('bukuAction').value = 'save_buku';
      resetBukuForm();

      new bootstrap.Modal(bukuModalEl).show();
    });
  });

  // Klik icon edit
  document.querySelectorAll('.btnEditBuku').forEach(icon => {
    icon.addEventListener('click', () => {
      const id = icon.getAttribute('data-id') || '';
      const personilId = icon.getAttribute('data-personil-id') || '';

      document.getElementById('bukuPersonilId').value = personilId;
      document.getElementById('bukuId').value = id;

      document.getElementById('bukuModalTitle').textContent = 'Edit Buku';
      document.getElementById('bukuAction').value = 'save_buku';

      document.getElementById('bukuJudul').value = icon.getAttribute('data-judul') || '';
      document.getElementById('bukuPenerbit').value = icon.getAttribute('data-penerbit') || '';
      document.getElementById('bukuHalaman').value = icon.getAttribute('data-halaman') || '';
      document.getElementById('bukuTahun').value = icon.getAttribute('data-tahun') || '';
      document.getElementById('bukuLink').value = icon.getAttribute('data-link') || '';

      new bootstrap.Modal(bukuModalEl).show();
    });
  });

  // Klik icon hapus
  document.querySelectorAll('.btnHapusBuku').forEach(icon => {
    icon.addEventListener('click', () => {
      const id = icon.getAttribute('data-id') || '';
      const personilId = icon.getAttribute('data-personil-id') || '';

      document.getElementById('hapusBukuId').value = id;
      document.getElementById('hapusPersonilId').value = personilId;

      new bootstrap.Modal(hapusModalEl).show();
    });
  });
</script>
