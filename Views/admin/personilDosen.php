<?php

$title = "Profil Saya";
$customCSS = "
    body {
        background-color: #f8f9fa;
    }
    .main-content {
        padding: 30px;
        width: calc(100% - 270px);
    }
    .card {
        border: none;
        box-shadow: 0 0 10px rgba(170, 117, 117, 0.05);
        border-radius: 10px;
    }
    .btn-simpan {
        background-color: #06315A;
        color: white;
        font-weight: 500;
        border-radius: 8px;
        padding: 8px 18px;
    }
    .photo-preview {
        margin-bottom: 15px;
    }
";

include __DIR__ . '/layout/header.php';

?>
<div class="d-flex">
    <?php include __DIR__ . '/layout/sidebar.php'; ?>
    <div class="main-content">
        <h3 class="fw-bold mb-4">Profil Saya</h3>
        <hr class="mt-0 mb-4">

        <div class="card p-4">
            <form id="dosenForm" enctype="multipart/form-data">
            <input type="hidden" id="personil-id" value="<?= htmlspecialchars($person['id_personil']) ?>">

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" id="personil-nama" class="form-control" value="<?= htmlspecialchars($person['nama']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" id="personil-nip" class="form-control" value="<?= htmlspecialchars($person['nip']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" id="personil-jabatan" class="form-control" value="<?= htmlspecialchars($person['jabatan']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" id="personil-email" class="form-control" value="<?= htmlspecialchars($person['email'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ruang</label>
                    <input type="text" id="personil-ruang" class="form-control" value="<?= htmlspecialchars($person['ruang_dosen'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">GitHub</label>
                    <input type="text" id="personil-github" class="form-control" value="<?= htmlspecialchars($person['github'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">LinkedIn</label>
                    <input type="text" id="personil-linkedin" class="form-control" value="<?= htmlspecialchars($person['linkedin'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" id="personil-photo" class="form-control">
                    <div id="photo-preview" class="photo-preview mt-2" <?= $person['photo_url'] ? '' : 'style="display:none"' ?>>
                        <img id="photo-img" src="<?= $person['photo_url'] ?? '' ?>" alt="Foto Dosen" style="max-width: 150px; border-radius: 8px;">
                    </div>
                </div>

                <button type="button" id="savePersonilBtn" class="btn-simpan">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('savePersonilBtn').addEventListener('click', function() {
    const id = document.getElementById('personil-id').value;
    const nama = document.getElementById('personil-nama').value;
    const nip = document.getElementById('personil-nip').value;
    const jabatan = document.getElementById('personil-jabatan').value;
    const email = document.getElementById('personil-email').value;
    const ruang = document.getElementById('personil-ruang').value;
    const github = document.getElementById('personil-github').value;
    const linkedin = document.getElementById('personil-linkedin').value;
    const photoFile = document.getElementById('personil-photo').files[0];

    if (!nama || !nip || !jabatan) {
        alert('Nama, NIP, dan Jabatan harus diisi');
        return;
    }

    if (photoFile && photoFile.size > 2 * 1024 * 1024) {
        alert('Ukuran file terlalu besar (maksimal 2MB)');
        return;
    }

    const formData = new FormData();
    formData.append('action', 'update');
    formData.append('id_personil', id);
    formData.append('nama', nama);
    formData.append('nip', nip);
    formData.append('jabatan', jabatan);
    formData.append('email', email);
    formData.append('ruang_dosen', ruang);
    formData.append('github', github);
    formData.append('linkedin', linkedin);
    if (photoFile) formData.append('photo', photoFile);

    fetch('/Controllers/api/personilApi.php', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Data berhasil diperbarui');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Gagal menyimpan data');
        });
});

// Preview foto
document.getElementById('personil-photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('photo-img').src = event.target.result;
            document.getElementById('photo-preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
</body>
</html>
