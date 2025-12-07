<?php
$title = "Pengelolaan Profil Lab";
$customCSS = "
    body {
        background-color: #f8f9fa; 
    }
    .main-content {
        padding: 30px;
        width: calc(100% - 270px);
    }
    .card {
        margin-bottom: 20px;
        border: none;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        border-radius: 10px;
    }
    .scope-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }
    .scope-item:last-child {
        border-bottom: none;
    }";

include_once __DIR__ . '/../layout/header.php';


?>


<body>
    <div class="d-flex">
        <?php include __DIR__ . '/layout/sidebar.php';
        include 'profilModals.php'; ?>
        <div class="main-content">
            <h3 class="fw-bold mb-4">Pengelolaan Profil Lab</h3>
            <hr class="mt-0 mb-4">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title fw-bold">Tentang Lab</h5>
                            <p class="card-text text-muted"><?php echo nl2br(htmlspecialchars($isiTentang)); ?></p>
                        </div>
                        <button class="btn btn-outline-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editTentangLabModal"
                            data-content="<?php echo htmlspecialchars($isiTentang); ?>">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title fw-bold">Visi</h5>
                            <p class="card-text text-muted"><?php echo nl2br(htmlspecialchars($isiVisi)); ?></p>
                        </div>
                        <button class="btn btn-outline-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editVisiMisiModal"
                            data-type="Visi"
                            data-id="2"
                            data-content="<?php echo htmlspecialchars($isiVisi); ?>">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title fw-bold">Misi</h5>
                            <p class="card-text text-muted"><?php echo nl2br(htmlspecialchars($isiMisi)); ?></p>
                        </div>
                        <button class="btn btn-outline-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editVisiMisiModal"
                            data-type="Misi"
                            data-id="6"
                            data-content="<?php echo htmlspecialchars($isiMisi); ?>">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3">
                <div class="card" style="max-width: 700px;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Scope dan Focus Lab</h5>

                        <?php if (!empty($scopes)):
                            foreach ($scopes as $scope):
                                $data = json_decode($scope['isi_konten'], true);
                                $judul = $data['title'] ?? 'Tanpa Judul';
                                $deskripsi = $data['description'] ?? '';
                                // Icon disimpan di kolom image_url (text)
                                $icon = $scope['image_url'] ?? '';
                        ?>

                                <div class="scope-item">
                                    <span>
                                        <i class="bi <?php echo htmlspecialchars($icon); ?> me-2"></i>
                                        <?php echo htmlspecialchars($judul); ?>
                                    </span>
                                    <div>
                                        <button class="btn btn-outline-primary btn-sm me-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editScopeModal"
                                            data-name="<?php echo htmlspecialchars($judul); ?>"
                                            data-desc="<?php echo htmlspecialchars($deskripsi); ?>"
                                            data-icon="<?php echo htmlspecialchars($scope['image_url']); ?>" data-id="<?php echo $scope['id_profile']; ?>">
                                            Edit
                                        </button>

                                        <form action="/admin/index.php" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus scope ini?');">
                                            <input type="hidden" name="action" value="delete_scope">
                                            <input type="hidden" name="id_to_delete" value="<?php echo $scope['id_profile']; ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted small text-center my-3">Belum ada data Focus & Scope.</p>
                        <?php endif; ?>
                        <a href="#" class="btn btn-link mt-3 p-0" data-bs-toggle="modal" data-bs-target="#editScopeModal" data-name="Tambah Focus">Tambah Focus</a>
                    </div>
                </div>

                <div class="card" style="max-width: 700px;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Roadmap</h5>

                        <?php if (!empty($roadmaps)):
                            foreach ($roadmaps as $roadmap):
                                $isiRoad = $roadmap['isi_konten'];
                        ?>

                                <div class="scope-item">
                                    <span><?php echo nl2br(htmlspecialchars($isiRoad)); ?></span>

                                    <div>
                                        <button class="btn btn-outline-primary btn-sm me-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editRoadmapModal"
                                            data-id="<?php echo $roadmap['id_profile']; ?>"
                                            data-content="<?php echo htmlspecialchars($isiRoad); ?>">
                                            Edit
                                        </button>

                                        <form action="/admin/index.php" method="POST" style="display:inline;"
                                            onsubmit="return confirm('Yakin ingin menghapus roadmap ini?');">
                                            <input type="hidden" name="action" value="delete_roadmap">
                                            <input type="hidden" name="id_to_delete" value="<?php echo $roadmap['id_profile']; ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>

                            <?php endforeach;
                        else: ?>
                            <p class="text-muted small text-center my-3">Belum ada data Roadmap.</p>
                        <?php endif; ?>

                        <a href="#" class="btn btn-link mt-3 p-0"
                            data-bs-toggle="modal"
                            data-bs-target="#editRoadmapModal">Tambah Roadmap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk mempassing data saat tombol edit diklik

        // 1. Tentang Lab
        const tentangModal = document.getElementById('editTentangLabModal');
        tentangModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const content = button.getAttribute('data-content');
            tentangModal.querySelector('textarea[name="isi_tentang"]').value = content;
        });

        // 2. Visi Misi
        const visiMisiModal = document.getElementById('editVisiMisiModal');
        visiMisiModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const type = button.getAttribute('data-type');
            const id = button.getAttribute('data-id');
            const content = button.getAttribute('data-content');

            visiMisiModal.querySelector('.modal-title').textContent = type;
            visiMisiModal.querySelector('#visiMisiType').value = id; // ID Profile
            visiMisiModal.querySelector('textarea[name="isi_visimisi"]').value = content;
        });

        // 3. Scope / Focus (Logic Update)
        const scopeModal = document.getElementById('editScopeModal');
        scopeModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const name = button.getAttribute('data-name');
            const desc = button.getAttribute('data-desc') || '';
            const icon = button.getAttribute('data-icon') || '';
            const scopeId = button.getAttribute('data-id') || '';

            const inputName = scopeModal.querySelector('#scope-name');
            const inputDesc = scopeModal.querySelector('#scope-description');
            const inputIcon = scopeModal.querySelector('#scope-icon');
            const inputId = scopeModal.querySelector('#scope-id');

            if (name === 'Tambah Focus') {
                scopeModal.querySelector('.modal-title').textContent = 'Tambah Fokus Lab';
                inputName.value = '';
                inputDesc.value = '';
                inputIcon.value = '';
                inputId.value = '';
            } else {
                scopeModal.querySelector('.modal-title').textContent = 'Edit Fokus Lab';
                inputName.value = name;
                inputDesc.value = desc;
                inputIcon.value = icon;
                inputId.value = scopeId;
            }
        });

        // ... (Bagian script lainnya)

        // 4. Roadmap (Perbaikan JS)
        const roadmapModal = document.getElementById('editRoadmapModal');

        roadmapModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;

            const getId = button.getAttribute('data-id') || '';
            const getContent = button.getAttribute('data-content') || '';

            // Asumsi: jika data-id ada, berarti operasi 'Edit', jika tidak, 'Tambah'
            const isEdit = getId !== '';

            // ✅ Mengakses elemen form yang benar
            const inputId = roadmapModal.querySelector('#roadmapType'); // ID Profile
            const textareaContent = roadmapModal.querySelector('textarea[name="isi_roadmap"]'); // Konten Roadmap
            const modalTitle = roadmapModal.querySelector('.modal-title');

            // ✅ Mengisi nilai ke elemen form
            inputId.value = getId;
            textareaContent.value = getContent;

            if (isEdit) {
                modalTitle.textContent = 'Edit Roadmap';
            } else {
                modalTitle.textContent = 'Tambah Roadmap';
            }
        });
    </script>
</body>

</html>