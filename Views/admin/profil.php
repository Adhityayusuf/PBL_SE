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
        background-color: #ffffff;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        padding: 20px;
        margin-bottom: 25px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
    }

    .card-text {
        color: #6c757d;
    }

    .btn-outline-primary {
        border-radius: 8px;
        padding: 5px 12px;
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
    }
        
    .prestasi-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }
    
    .prestasi-item:last-child {
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


            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Prestasi Lab</h5>

                    <?php if (!empty($prestasi)):
                        foreach ($prestasi as $ach): ?>
                            <div class="prestasi-item">
                                <span>
                                    <?php echo htmlspecialchars($ach['prestasi']); ?>
                                    <small class="text-muted ms-2">(<?php echo htmlspecialchars($ach['image_url']); ?>)</small>
                                </span>
                                <div>
                                    <button class="btn btn-outline-primary btn-sm me-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editPrestasiModal"
                                        data-id="<?php echo $ach['id_prestasi']; ?>"
                                        data-prestasi="<?php echo htmlspecialchars($ach['prestasi']); ?>"
                                        data-image="<?php echo htmlspecialchars($ach['image_url']); ?>">
                                        Edit
                                    </button>

                                    <form action="/admin/index.php" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?');">
                                        <input type="hidden" name="action" value="delete_prestasi">
                                        <input type="hidden" name="id_to_delete" value="<?php echo $ach['id_prestasi']; ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted small text-center my-3">Belum ada data Prestasi.</p>
                    <?php endif; ?>

                    <a href="#" class="btn btn-link mt-3 p-0"
                        data-bs-toggle="modal"
                        data-bs-target="#editPrestasiModal">Tambah Prestasi</a>
                </div>
            </div>


            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Scope dan Focus Lab</h5>

                            <?php if (!empty($scopes)):
                                foreach ($scopes as $scope):
                                    $judul = $scope['isi_konten'] ?? 'Tanpa Judul';
                                    $icon = $scope['image_url'] ?? ''; ?>
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
                </div>

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Roadmap</h5>

                            <?php if (!empty($roadmaps)):
                                foreach ($roadmaps as $roadmap):
                                   $desc = $roadmap['description'];
                                   $title = $roadmap['title'];
                            ?>
                                <div class="scope-item">
                                    <span>
                                        <strong><?php echo htmlspecialchars($title); ?></strong><br>
                                        <small class="text-muted"><?php echo htmlspecialchars($desc); ?></small>
                                    </span>

                                    <div>
                                        <button class="btn btn-outline-primary btn-sm me-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editRoadmapModal"
                                            data-id="<?php echo $roadmap['id_profile']; ?>"
                                            data-content='<?php echo json_encode(["title" => $title, "description" => $desc]); ?>'>
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

        const prestasiModal = document.getElementById('editPrestasiModal');
        prestasiModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id') || '';
            const prestasi = button.getAttribute('data-prestasi') || '';
            const image = button.getAttribute('data-image') || '';
            const previewContainer = document.getElementById('photo-preview');
            const previewImg = document.getElementById('photo-img');

            prestasiModal.querySelector('#prestasiId').value = id;
            prestasiModal.querySelector('#prestasiName').value = prestasi;
            prestasiModal.querySelector('#prestasiImage').value = image;

            if (id === '') {
                prestasiModal.querySelector('.modal-title').textContent = 'Tambah Prestasi';
            } else {
                prestasiModal.querySelector('.modal-title').textContent = 'Edit Prestasi';
            }

            if (image) {
                const fullImageUrl = '/Views/assets/uploads/prestasi/' + image;

                previewImg.src = fullImageUrl;
                previewContainer.style.display = 'block';
            } else {
                previewContainer.style.display = 'none';
                previewImg.src = '';
            }

            document.getElementById('prestasiFile').value = '';
        });


        // 3. Scope / Focus (Logic Update)
        const scopeModal = document.getElementById('editScopeModal');
        scopeModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const name = button.getAttribute('data-name');
            const icon = button.getAttribute('data-icon') || '';
            const scopeId = button.getAttribute('data-id') || '';

            const inputName = scopeModal.querySelector('#scope-name');
            const inputIcon = scopeModal.querySelector('#scope-icon');
            const inputId = scopeModal.querySelector('#scope-id');

            if (name === 'Tambah Focus') {
                scopeModal.querySelector('.modal-title').textContent = 'Tambah Fokus Lab';
                inputName.value = '';
                inputIcon.value = '';
                inputId.value = '';
            } else {
                scopeModal.querySelector('.modal-title').textContent = 'Edit Fokus Lab';
                inputName.value = name;
                inputIcon.value = icon;
                inputId.value = scopeId;
            }
        });


        // 4. Roadmap (Perbaikan JS)
        const roadmapModal = document.getElementById('editRoadmapModal');

        roadmapModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id') || '';
        const content = button.getAttribute('data-content');

        const inputId = roadmapModal.querySelector('#roadmapType');
        const inputTitle = roadmapModal.querySelector('input[name="roadmap_title"]');
        const inputDesc = roadmapModal.querySelector('textarea[name="roadmap_description"]');
        const modalTitle = roadmapModal.querySelector('.modal-title');

        inputId.value = id;

        if (id && content) {
            // EDIT MODE
            const json = JSON.parse(content);
            inputTitle.value = json.title ?? '';
            inputDesc.value = json.description ?? '';
            modalTitle.textContent = 'Edit Roadmap';
        } else {
            // TAMBAH MODE
            inputTitle.value = '';
            inputDesc.value = '';
            modalTitle.textContent = 'Tambah Roadmap';
        }
    });
    </script>
</body>

</html>