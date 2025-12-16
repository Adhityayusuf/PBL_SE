<?php
$title = "Profil Saya";

$customCSS = "
body {
    background: #F5F5F7;
    overflow-x: hidden;
}

.main-content {
    padding: 30px 15px;
    width: 100%;
}

.page-header {
    background: #ffffff;
    padding: 20px 28px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,.04);
}

.page-content {
    background: #ffffff;
    padding: 28px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,.04);
}

.form-label {
    font-weight: 600;
    font-size: 14px;
    color: #374151;
}

.form-control,
.form-select,
textarea.form-control {
    border-radius: 8px;
    padding: 10px 14px;
}

.form-control:focus,
.form-select:focus,
textarea.form-control:focus {
    border-color: #06315A;
    box-shadow: 0 0 0 0.15rem rgba(6,49,90,.15);
}

.btn-simpan {
    background-color: #06315A;
    color: #fff;
    font-weight: 500;
    border-radius: 8px;
    padding: 10px 22px;
    border: none;
}

.btn-simpan:hover {
    background-color: #05294b;
}

.photo-preview img {
    box-shadow: 0 4px 10px rgba(0,0,0,.08);
}

.main-content {
    background-color: #F5F5F7;
}
";

include __DIR__ . '/../admin/layout/header.php';
?>

<div class="d-flex min-vh-100">
    <?php include __DIR__ . '/../admin/layout/sidebar.php'; ?>

    <div class="main-content flex-grow-1">

        <div class="page-header">
            <h2 class="fw-bold fs-3 mb-0">
                <i class="bi bi-person-circle"></i> Profil Saya
            </h2>
        </div>

        <div class="page-content m-4">
            <form id="dosenForm" enctype="multipart/form-data">
                <input type="hidden" name="id_personil" value="<?= htmlspecialchars($person['id_personil'] ?? '') ?>">

                <!-- ROW 1: Nama + Jenis Kelamin -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Nama</label>
                        <input type="text" name="nama" class="form-control"
                               value="<?= htmlspecialchars($personil['nama'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" <?= ($personil['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($personil['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>

                <!-- ROW 2: NIP + NIDN -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">NIP</label>
                        <input type="text" name="nip" class="form-control"
                               value="<?= htmlspecialchars($personil['nip'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIDN</label>
                        <input type="text" name="nidn" class="form-control"
                               value="<?= htmlspecialchars($personil['nidn'] ?? '') ?>">
                    </div>
                </div>

                <!-- ROW 3: Jabatan + Ruang Dosen -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control"
                               value="<?= htmlspecialchars($personil['jabatan'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ruang Dosen</label>
                        <input type="text" name="ruang_dosen" class="form-control"
                               value="<?= htmlspecialchars($personil['ruang_dosen'] ?? '') ?>">
                    </div>
                </div>

                <!-- ROW 4: Kontak + Alamat Kantor -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control"
                               value="<?= htmlspecialchars($personil['no_telp'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alamat Kantor</label>
                        <textarea name="alamat_kantor" class="form-control" rows="2"><?= htmlspecialchars($personil['alamat_kantor'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- DESC DIRI -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi Diri</label>
                    <textarea name="desc_diri" class="form-control" rows="3"><?= htmlspecialchars($personil['desc_diri'] ?? '') ?></textarea>
                </div>

                <!-- CONTENT SOCIAL -->
                <?php $contentSocial = json_decode($personil['content_social'] ?? '{}', true); ?>
                <h5 class="fw-bold mt-4 mb-3">Media & Profil Akademik</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Website Pribadi</label>
                        <input type="text" name="content_social[website]" class="form-control"
                               value="<?= htmlspecialchars($contentSocial['website'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Google Scholar</label>
                        <input type="text" name="content_social[google_scholar]" class="form-control"
                               value="<?= htmlspecialchars($contentSocial['google_scholar'] ?? '') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ORCID</label>
                        <input type="text" name="content_social[orcid]" class="form-control"
                               value="<?= htmlspecialchars($contentSocial['orcid'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Scopus ID</label>
                        <input type="text" name="content_social[scopus]" class="form-control"
                               value="<?= htmlspecialchars($contentSocial['scopus'] ?? '') ?>">
                    </div>
                </div>

                <!-- MATA KULIAH -->
                <?php $mataKuliah = json_decode($personil['mata_kuliah'] ?? '[]', true); ?>
                <h5 class="fw-bold mt-4 mb-3">Mata Kuliah</h5>
                <div class="mb-3">
                    <textarea name="mata_kuliah" class="form-control" rows="3" placeholder="Pisahkan dengan koma"><?= htmlspecialchars(implode(', ', $mataKuliah)) ?></textarea>
                    <small class="text-muted">Contoh: Matematika, Fisika, Pemrograman</small>
                </div>

                <!-- MAHASISWA LULUS -->
                <?php $mhsLulus = json_decode($personil['mhs_lulus'] ?? '{}', true); ?>
                <h5 class="fw-bold mt-4 mb-3">Jumlah Mahasiswa Lulus</h5>
                <div class="row">
                    <?php foreach ($mhsLulus as $tahun => $jumlah): ?>
                        <div class="col-md-3 mb-3">
                            <label class="form-label"><?= htmlspecialchars($tahun) ?></label>
                            <input type="number" name="mhs_lulus[<?= htmlspecialchars($tahun) ?>]" class="form-control"
                                   value="<?= htmlspecialchars($jumlah) ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- FOTO -->
                <h5 class="fw-bold mt-4 mb-3">Foto Profil</h5>
                <div class="mb-3">
                    <label class="form-label">Upload Foto</label>
                    <input type="file" name="photo" id="personil-photo" class="form-control">
                    <div id="photo-preview" class="photo-preview mt-3" <?= empty($personil['photo_url']) ? 'style="display:none"' : '' ?>>
                        <img id="photo-img" src="<?= htmlspecialchars($personil['photo_url'] ?? '') ?>" style="max-width:150px;border-radius:10px;">
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" id="savePersonilBtn" class="btn-simpan">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('savePersonilBtn').addEventListener('click', function () {
    const formData = new FormData(document.getElementById('dosenForm'));
    formData.append('action', 'update');
    fetch('/Controllers/api/personilApi.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Data berhasil diperbarui');
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(() => alert('Gagal menyimpan data'));
});

document.getElementById('personil-photo').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (evt) {
        document.getElementById('photo-img').src = evt.target.result;
        document.getElementById('photo-preview').style.display = 'block';
    };
    reader.readAsDataURL(file);
});
</script>

</body>
</html>
