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
                        <option value="Ruang Dosen 5">Ruang Dosen 5</option>
                        <option value="Ruang Dosen 6">Ruang Dosen 6</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="personil-photo" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="personil-photo" name="photo" accept="image/*">
                    <small class="text-muted">Unggah file gambar (JPG, PNG, GIF). Ukuran maksimal: 2MB</small>
                    <div id="photo-preview" class="mt-2" style="display: none;">
                        <img id="photo-img" src="" alt="Preview Foto" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Link Eksternal</label>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex justify-content-center align-items-center bg-primary text-white rounded-circle me-3 shadow-sm" 
                            style="width: 35px; height: 35px; min-width: 35px;">
                            <i class="bi bi-github fs-5"></i>
                        </div>
                        <input type="url" class="form-control" id="personil-github" name="github" placeholder="">
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-center align-items-center bg-primary text-white rounded-circle me-3 shadow-sm" 
                            style="width: 35px; height: 35px; min-width: 35px;">
                            <i class="bi bi-linkedin fs-5"></i>
                        </div>
                        <input type="url" class="form-control" id="personil-linkedin" name="linkedin" placeholder="">
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