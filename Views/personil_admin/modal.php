<?php
// File: /Views/personil_admin/modal_aktivitas.php
// Modal ini digunakan untuk formulir Tambah/Edit Penelitian, Pengabdian, atau HKI.
// ID Modal: #aktivitasModal

// Catatan: Pastikan Anda memuat file ini di akhir file View Anda (setelah </div> penutup div.d-flex).
?>

<div class="modal fade" id="aktivitasModal" tabindex="-1" aria-labelledby="aktivitasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="aktivitasModalLabel">
                    <i class="bi bi-plus-lg me-2"></i> Tambah Data Aktivitas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="aktivitasForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="action" id="formAction">
                    <input type="hidden" name="tipe_aktivitas" id="tipeAktivitas">
                    <input type="hidden" name="id_personil" id="modalPersonilId">
                    <input type="hidden" name="id_aktivitas" id="modalAktivitasId">

                    <div class="mb-3">
                        <label for="judul" class="form-label required" id="labelJudul">Judul</label>
                        <textarea class="form-control" name="judul" id="judul" rows="3" required></textarea>
                    </div>

                    <div class="row row-dana-pkm">
                        <div class="col-md-6 mb-3">
                            <label for="sumber_dana" class="form-label">Sumber Dana</label>
                            <input type="text" class="form-control" name="sumber_dana" id="sumber_dana">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jml_dana" class="form-label">Jumlah Dana (Rp)</label>
                            <input type="number" class="form-control" name="jml_dana" id="jml_dana" min="0">
                        </div>
                    </div>
                    
                    <div class="row row-hki" style="display: none;">
                         <div class="col-md-6 mb-3">
                            <label for="jenis_hki" class="form-label required">Jenis HKI</label>
                            <input type="text" class="form-control" name="jenis_hki" id="jenis_hki">
                        </div>
                         <div class="col-md-6 mb-3">
                            <label for="no_pdd" class="form-label">No. PDD/Kontrak</label>
                            <input type="text" class="form-control" name="no_pdd" id="no_pdd">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tahun" class="form-label required">Tahun</label>
                            <input type="number" class="form-control" name="tahun" id="tahun" required min="1950" max="<?= date('Y') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="link" class="form-label">Link/URL Publikasi</label>
                            <input type="url" class="form-control" name="link" id="link">
                        </div>
                    </div>
                    
                    <div id="modalAlert" class="alert mt-3" style="display: none;"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="submitModalBtn" class="btn-simpan">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>