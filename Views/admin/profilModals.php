<div class="modal fade modal-visi" id="editTentangLabModal" tabindex="-1" aria-labelledby="editTentangLabModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-3 fw-bold" id="editTentangLabModalLabel">Tentang Lab</h5>
            </div>
            <div class="modal-body pt-0">
                <form id="tentangLabForm" action="/admin/index.php" method="POST">
                    <input type="hidden" name="action" value="update_tentang">
                    <textarea class="form-control" rows="5" name="isi_tentang"></textarea>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-end border-0 pt-0">
                <button type="button" class="btn btn-light btn-lg me-2 px-4" data-bs-dismiss="modal" style="font-weight: 500;">Batal</button>
                <button type="button" class="btn btn-primary btn-lg px-4" onclick="document.getElementById('tentangLabForm').submit()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-visi" id="editVisiModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-3 fw-bold">Edit Visi</h5>
            </div>
            <div class="modal-body pt-0">
                <form id="visiForm" action="/admin/index.php" method="POST">
                    <input type="hidden" name="action" value="update_visi">
                    <textarea class="form-control" rows="5" name="isi_visi" required></textarea>
                </form>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button class="btn btn-light btn-lg" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary btn-lg"
                        onclick="document.getElementById('visiForm').submit()">Simpan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-visi" id="editMisiModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-3 fw-bold">Edit Misi</h5>
            </div>
            <div class="modal-body pt-0">
                <form id="misiForm" action="/admin/index.php" method="POST">
                    <input type="hidden" name="action" value="update_misi">
                    <textarea class="form-control" rows="5" name="isi_misi" required></textarea>
                </form>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button class="btn btn-light btn-lg" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary btn-lg"
                        onclick="document.getElementById('misiForm').submit()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPrestasiModal" tabindex="-1" aria-labelledby="editPrestasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-3 fw-bold" id="editPrestasiModalLabel">Prestasi</h5>
            </div>
            <div class="modal-body pt-0">
                <form id="prestasiForm" action="/admin/index.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="update_prestasi">
                    <input type="hidden" name="id_prestasi" id="prestasiId">
                    <div class="mb-3">
                        <label for="prestasiName" class="form-label">Prestasi</label>
                        <input type="text" class="form-control" name="prestasi" id="prestasiName">
                    </div>
                    <div class="mb-3">
                        <label for="prestasiFile" class="form-label">Upload Gambar (opsional)</label>
                        <input type="file" class="form-control" name="image_url" id="prestasiFile">
                        <input type="hidden" name="old_image_url" id="prestasiImage">
                    </div>
                </form>

                <div id="photo-preview" class="mt-2 text-left" style="display: none; padding-top: 10px;">
                    <p class="small text-muted mb-1">Preview Gambar Saat Ini:</p>
                    <img id="photo-img" src="" alt="Preview Foto" style="max-width: 100%; max-height: 200px; object-fit: contain; border-radius: 8px;">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end border-0 pt-0">
                <button type="button" class="btn btn-light btn-lg me-2 px-4" data-bs-dismiss="modal" style="font-weight: 500;">Batal</button>
                <button type="button" class="btn btn-primary btn-lg px-4" onclick="document.getElementById('prestasiForm').submit()">Simpan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editScopeModal" tabindex="-1" aria-labelledby="editScopeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="editScopeModalLabel">Scope dan Fokus Lab</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="scopeForm" action="/admin/index.php" method="POST">
                    <input type="hidden" name="action" value="save_scope">

                    <div class="mb-3">
                        <label for="scope-name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="scope-name" name="scope_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="scope-icon" class="form-label">Kode Icon (Bootstrap Icons)</label>
                        <input class="form-control" type="text" id="scope-icon" name="scope_icon" placeholder="Contoh: bi-code-slash">
                        <small class="text-muted">Cari kode icon di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
                    </div>

                    <input type="hidden" id="scope-id" name="scope_id" value="">
                </form>
            </div>
            <div class="modal-footer justify-content-end border-0 pt-0">
                <button type="button" class="btn btn-light btn-lg me-2 px-4" data-bs-dismiss="modal" style="font-weight: 500;">Batal</button>
                <button type="button" class="btn btn-primary btn-lg px-4" onclick="document.getElementById('scopeForm').submit()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit / Tambah Roadmap -->
<div class="modal fade modal-visi" id="editRoadmapModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-3 fw-bold">Edit Roadmap</h5>
            </div>

            <div class="modal-body pt-0">
                <form id="roadmapForm" action="/admin/index.php" method="POST">
                    <input type="hidden" name="action" value="save_roadmap">
                    <input type="hidden" name="id_profile" id="roadmapType">

                    <!-- TITLE -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title</label>
                        <input type="text" class="form-control" name="roadmap_title" required>
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" rows="4" name="roadmap_description" required></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light btn-lg" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-lg"
                        onclick="document.getElementById('roadmapForm').submit()">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
