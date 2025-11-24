<div class="modal fade modal-visi" id="editTentangLabModal" tabindex="-1" aria-labelledby="editTentangLabModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fs-3 fw-bold" id="editTentangLabModalLabel">Tentang Lab</h5>
    </div>
    <div class="modal-body pt-0">
        <form id="tentangLabForm"> 
            <textarea class="form-control" rows="5" name="isi_tentang">Lab Software Engineering merupakan salah satu laboratorium di bawah Jurusan Teknologi Informasi, Politeknik Negeri Malang.</textarea>
            <input type="hidden" name="type" value="Tentang Lab">
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
        <form id="visiMisiForm">
            <textarea class="form-control" rows="5" name="isi_visimisi">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore</textarea>
            <input type="hidden" name="type" id="visiMisiType">
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
        <form id="scopeForm">
        <div class="mb-3">
            <label for="scope-name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="scope-name" name="scope_name" required value="Web Development">
        </div>
        <div class="mb-3">
            <label for="scope-description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="scope-description" name="scope_description" rows="4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore</textarea>
        </div>
        <div class="mb-3">
            <label for="scope-icon" class="form-label">Ikon</label>
            <input class="form-control" type="file" id="scope-icon" name="scope_icon">
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

<script>
    // 1. modal Visi/Misi
    const visiMisiModal = document.getElementById('editVisiMisiModal');
    if (visiMisiModal) {
    visiMisiModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget; 
        const type = button.getAttribute('data-type');
        const modalTitle = visiMisiModal.querySelector('.modal-title');
        modalTitle.textContent = type;
    });
    }

    // 2. modal Scope/Focus
    const scopeModal = document.getElementById('editScopeModal');
    if (scopeModal) {
    scopeModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const name = button.getAttribute('data-name');
        const scopeId = button.getAttribute('data-id');
        
        const inputName = scopeModal.querySelector('#scope-name');
        const inputDesc = scopeModal.querySelector('#scope-description'); 
        const inputId = scopeModal.querySelector('#scope-id');

    if (name === 'Tambah Focus') {
        
        scopeModal.querySelector('.modal-title').textContent = 'Tambah Fokus Lab';
        inputName.value = '';
        inputDesc.value = ''; 
        inputId.value = '';
    } else {
        
        scopeModal.querySelector('.modal-title').textContent = 'Edit Fokus Lab';
        inputName.value = name;
        inputId.value = scopeId;
    }
});
}
</script>