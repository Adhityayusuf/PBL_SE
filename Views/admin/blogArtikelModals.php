<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content custom-modal">
            <div class="modal-body p-4">
                <h5 class="modal-title fw-bold mb-4">Tambah Artikel</h5>

                <form action="/admin/index.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="addArtikel">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select class="form-select" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategoriList as $kat): ?>
                                <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Author</label>
                        <input type="text" class="form-control" name="author" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Publikasi</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload Gambar (Cover)</label>
                        <input type="file" class="form-control" name="gambar" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subtitle (Deskripsi Singkat)</label>
                        <textarea class="form-control" name="subtitle" rows="2" placeholder="Masukkan ringkasan singkat artikel..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Isi Konten</label>
                        <textarea class="form-control" rows="4" name="deskripsi"></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content custom-modal">
            <div class="modal-body p-4">
                <h5 class="modal-title fw-bold mb-4">Edit Artikel</h5>

                <form id="formEdit" action="/admin/index.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="editArtikel">
                    <input type="hidden" name="id" id="editId">
                    <input type="hidden" name="old_image" id="editOldImage">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" class="form-control" name="judul" id="editJudul" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select class="form-select" name="kategori" id="editKategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategoriList as $kat): ?>
                                <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Author</label>
                        <input type="text" class="form-control" name="author" id="editAuthor" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Publikasi</label>
                        <input type="date" class="form-control" name="tanggal" id="editTanggal" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ganti Gambar (Opsional)</label>
                        <input type="file" class="form-control" name="gambar" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>



                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subtitle (Deskripsi Singkat)</label>
                        <textarea class="form-control" name="subtitle" id="editSubtitle" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Isi Konten</label>
                        <textarea class="form-control" rows="4" name="deskripsi" id="editDeskripsi"></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/index.php" method="POST">
                <input type="hidden" name="action" value="deleteArtikel">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus artikel ini?</p>
                    <input type="hidden" name="id_hapus" id="hapusId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // === POPUP TAMBAH ===
    document.querySelector('.btnTambahArtikel').addEventListener('click', () => {
        new bootstrap.Modal(document.getElementById('modalTambah')).show();
    });

    // === POPUP EDIT (Isi data otomatis) ===
    document.querySelectorAll('.action-icon.edit').forEach((btn) => {
        btn.addEventListener('click', () => {
            const tr = btn.closest('tr');

            document.getElementById('editId').value = tr.dataset.id;
            document.getElementById('editJudul').value = tr.dataset.judul;

            // --- TAMBAHAN BARU: Ambil Subtitle ---
            document.getElementById('editSubtitle').value = tr.dataset.subtitle;
            // -------------------------------------

            document.getElementById('editKategori').value = tr.dataset.kategori;
            document.getElementById('editAuthor').value = tr.dataset.author;
            document.getElementById('editTanggal').value = tr.dataset.tanggal;
            document.getElementById('editDeskripsi').value = tr.dataset.deskripsi;
            document.getElementById('editOldImage').value = tr.dataset.image;

            new bootstrap.Modal(document.getElementById('modalEdit')).show();
        });
    });

    // === POPUP HAPUS ===
    document.querySelectorAll('.action-icon.delete').forEach((btn) => {
        btn.addEventListener('click', () => {
            const id = btn.closest('tr').dataset.id;
            document.getElementById('hapusId').value = id;
            new bootstrap.Modal(document.getElementById('modalHapus')).show();
        });
    });
</script>