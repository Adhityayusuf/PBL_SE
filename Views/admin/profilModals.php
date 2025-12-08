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

<div class="modal fade modal-visi" id="editVisiMisiModal" tabindex="-1" aria-labelledby="editVisiMisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-3 fw-bold" id="editVisiMisiModalLabel">Visi</h5>
            </div>
            <div class="modal-body pt-0">
                <form id="visiMisiForm" action="/admin/index.php" method="POST">
                    <input type="hidden" name="action" value="update_visimisi">
                    <input type="hidden" name="id_profile" id="visiMisiType">
                    <textarea class="form-control" rows="5" name="isi_visimisi"></textarea>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-end border-0 pt-0">
                <button type="button" class="btn btn-light btn-lg me-2 px-4" data-bs-dismiss="modal" style="font-weight: 500;">Batal</button>
                <button type="button" class="btn btn-primary btn-lg px-4" onclick="document.getElementById('visiMisiForm').submit()">Simpan</button>
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
                        <label for="scope-description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="scope-description" name="scope_description" rows="4"></textarea>
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
<div class="modal fade modal-visi" id="editRoadmapModal" tabindex="-1" aria-labelledby="editVisiMisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-3 fw-bold" id="editRoadmapModalLabel">Edit Roadmap</h5>
            </div>
            <div class="modal-body pt-0">
                <form id="roadmapForm" action="/admin/index.php" method="POST">
                    <input type="hidden" name="action" value="save_roadmap">
                    <input type="hidden" name="id_profile" id="roadmapType">
                    <textarea class="form-control" rows="5" name="isi_roadmap"></textarea>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-end border-0 pt-0">
                <button type="button" class="btn btn-light btn-lg me-2 px-4" data-bs-dismiss="modal" style="font-weight: 500;">Batal</button>
                <button type="button" class="btn btn-primary btn-lg px-4" onclick="document.getElementById('roadmapForm').submit()">Simpan</button>
            </div>
        </div>
    </div>
</div>
