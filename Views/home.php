<?php

require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/layout/navbar.php";
?>

<section class="py-5 hero-section modern-hero d-flex align-items-center" id="tentang-lab">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-5 d-flex flex-column align-items-center justify-content-center">
                <img src="/Views/assets/maskot.png" class="img-fluid hero-maskot-img mb-4" alt="Maskot Lab SE">
            </div>

            <div class="col-lg-7 col-md-7 text-md-start text-center mt-4 mt-md-0">
                <div class="se-card mb-2">
                    <p class="section-tag-small">💻 Inovasi Software Terdepan</p>
                </div>
                <h1 class="fw-bold fs-1 hero-title">Selamat Datang di Lab</h1>
                <h1 class="fw-bold fs-1 text-warning hero-subtitle">Software Engineering</h1>

                <p class="text-light fs-5 mt-4">
                    <?php echo nl2br(htmlspecialchars($about_lab['isi_konten'])); ?>
                </p>

                <div class="se-button-card mt-2 mb-2">
                    <a href="#prestasi" class="btn btn-primary-custom btn-lg">Jelajahi Prestasi <i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="d-flex gap-4 justify-content-md-start justify-content-center mt-3 skill-tags"
                    style="margin-top:20px; display:flex; gap:20px;">

                    <?php foreach ($scopes as $item): ?>
                        <span class="skill-tag-item se-card">
                            <i class="bi <?php echo htmlspecialchars($item['image_url']); ?>"></i>
                            <?php echo htmlspecialchars($item['isi_konten']); ?>
                        </span>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<hr class="my-5 opacity-25">

<!-- PRESTASI -->
<section id="prestasi" class="container py-5">
    <div class="row align-items-center justify-content-center">

        <div class="col-md-6 order-md-2">
            <h2 class="fw-bold section-title-flex text-md-start mb-4">Pencapaian</h2>

            <div class="achievement-card p-4">
                <ul class="list-unstyled deskripsi-text">

                    <?php if (!empty($prestasi)): ?>
                        <?php foreach ($prestasi as $a): ?>
                            <li>
                                <i class="bi bi-star-fill text-warning me-2"></i>
                                <?= htmlspecialchars($a['prestasi']); ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="deskripsi-text">Data prestasi belum tersedia.</p>
                    <?php endif; ?>

                </ul>
            </div>
        </div>

        <div class="col-md-6 order-md-1 mt-4 mt-md-0 text-left">
            <div id="slider">
                <?php if (!empty($prestasi)): ?>
                    <?php $i = 1;
                    foreach ($prestasi as $a): ?>
                        <img
                            id="sliderImage<?= $i ?>"
                            src="/Views/assets/uploads/prestasi/<?= htmlspecialchars($a['image_url']); ?>"
                            alt="<?= htmlspecialchars($a['prestasi']); ?>"
                            <?= $i > 1 ? 'style="display:none;"' : '' ?>>
                    <?php $i++;
                    endforeach; ?>
                <?php else: ?>
                    <img src="/Views/assets/placeholder.jpg" alt="No Achievement">
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<hr class="my-5 opacity-25">

<!-- PERSONIL -->
<section id="personil-section" class="team-carousel-section">
    <div class="title-container d-flex justify-content-center align-items-center">
        <img src="/Views/assets/our_team.png" class="section-icon" alt="Our Team Icon">
        <h2 class="section-title-flex">OUR TEAM</h2>
    </div>

    <div class="owl-carousel owl-theme">
        <?php if (!empty($personil)): ?>
            <?php foreach ($personil as $p): ?>
                <div class="item">
                    <div class="team-member-card">
                        <img src="<?= htmlspecialchars($p['photo_url'] ?? $p['img'] ?? 'personil_default.jpg'); ?>">
                        <div class="team-member-info">
                            <h5><?= htmlspecialchars($p['nama']); ?></h5>
                            <p><?= htmlspecialchars($p['jabatan']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-light">Data Personil belum tersedia.</p>
        <?php endif; ?>
    </div>

    <a href="/index.php?action=personil" class="btn btn-data-dosen">Lihat Data Dosen</a>
</section>

<hr class="my-5 opacity-25">

<!-- SCOPE -->
<section id="focus-scope-section" class="container py-5 text-center">
    <h2 class="section-title-flex mb-4">Focus dan Scope Penelitian</h2>

    <div class="row g-4 justify-content-center mt-5">
        <?php if (!empty($scopes)): ?>
            <?php foreach ($scopes as $scope):
                $title = $scope['isi_konten'] ?? 'Judul Tidak Tersedia';
                $icon = $scope['image_url'] ?? 'bi-code-slash';
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="icon-box">
                        <i class="bi <?= htmlspecialchars($icon); ?> text-warning"></i>
                    </div>
                    <p class="text-light mt-2"><?= htmlspecialchars($title); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-light">Data Focus & Scope belum tersedia.</p>
        <?php endif; ?>
    </div>
</section>

<hr class="my-5 opacity-25">

<!-- ROADMAP -->
<section id="roadmap-section" class="container py-5">
    <h2 class="section-title-flex mb-5 text-center">Roadmap Lab SE</h2>

    <div class="roadmap-timeline clearfix">
        <?php if (!empty($roadmaps)): ?>
            <?php foreach ($roadmaps as $r): ?>
                <div class="roadmap-item">
                    <div class="card-custom">
                        <h5><?= htmlspecialchars($r['title']); ?></h5>
                        <p class="small"><?= htmlspecialchars($r['description']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-light">Data Roadmap belum tersedia.</p>
        <?php endif; ?>
    </div>
</section>

<hr class="my-5 opacity-25">

<!-- BLOG -->
<section id="blog-section" class="container pb-5">
    <div class="row g-4">
        <?php if (empty($artikel)): ?>
            <div class="col-12 text-center py-5">
                <div style="background: rgba(255,255,255,0.05); padding: 40px; border-radius: 20px;">
                    <i class="bi bi-journal-x" style="font-size: 3rem; opacity: 0.5;"></i>
                    <h4 class="mt-3 text-white-50">Tidak ada artikel ditemukan.</h4>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($artikel as $row): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="blog-card-custom">

                        <div class="blog-card-header"
                            style="background-image: url('<?= htmlspecialchars($row['image_url'] ?? '/assets/acv1.jpg'); ?>');">
                        </div>

                        <div class="blog-card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="category-tag"><?= htmlspecialchars($row['nama_kategori'] ?? 'Umum'); ?></span>
                                <small><?= date('d/m/Y', strtotime($row['tanggal_publikasi'])); ?></small>
                            </div>

                            <h5 class="fw-bold mb-2"><?= htmlspecialchars($row['title']); ?></h5>
                            <p class="small text-muted"><?= htmlspecialchars($row['subtitle']); ?></p>

                            <a href="/index.php?action=artikel&id=<?= htmlspecialchars($row['id_artikel']); ?>"
                                class="read-now">Read Now</a>
                        </div>

                        <div class="blog-card-footer">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span class="author-name"><?= htmlspecialchars($row['penulis']); ?></span>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-center">
        <a href="/index.php?action=blog" class="btn btn-all-blog">Lihat lebih banyak</a>
    </div>
</section>

<?php require_once __DIR__ . "/layout/footer.php"; ?>