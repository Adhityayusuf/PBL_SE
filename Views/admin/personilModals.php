<!-- Modal Data Dosen -->
<div class="modal fade" id="personilModal" tabindex="-1" aria-labelledby="personilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-4 fw-bold" id="personilModalLabel">Data Dosen</h5>
            </div>
            <div class="modal-body pt-0">
                <div class="mb-3">
                    <label for="personil-nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="personil-nama" name="nama" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="personil-nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="personil-nip" name="nip" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="personil-jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="personil-jabatan" name="jabatan" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="personil-email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="personil-email" name="email" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="personil-ruang" class="form-label">Ruang Dosen</label>
                    <select class="form-select" id="personil-ruang" name="ruang">
                        <option value="">-- Pilih Ruang --</option>
                        <option value="Ruang Dosen 1">Ruang Dosen 1</option>
                        <option value="Ruang Dosen 2">Ruang Dosen 2</option>
                        <option value="Ruang Dosen 3">Ruang Dosen 3</option>
                        <option value="Ruang Dosen 4">Ruang Dosen 4</option>
                    </select>
                </div>

                <div class="mb-3">
                <label class="form-label">Link Eksternal</label>
                
                <div class="input-group mb-2">
                    <span class="input-group-text bg-primary text-white">
                        <i class="bi bi-github"></i> 
                    </span>
                    <input type="url" class="form-control" id="personil-github" name="github" placeholder="URL GitHub">
                </div>

                <div class="input-group">
                    <span class="input-group-text bg-primary text-white">
                        <i class="bi bi-linkedin"></i> 
                    </span>
                    <input type="url" class="form-control" id="personil-linkedin" name="linkedin" placeholder="URL LinkedIn">
                </div>
            </div>
                <input type="hidden" id="personil-id" name="id" value="">
            </div>
            <div class="modal-footer d-flex justify-content-end border-0 pt-0">
                <button type="button" class="btn btn-light btn-lg me-2 px-4" data-bs-dismiss="modal" style="font-weight: 500;">Batal</button>
                <button type="button" class="btn btn-primary btn-lg px-4" id="savePersonilBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>