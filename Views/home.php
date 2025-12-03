<?php
define('BASE_PATH', __DIR__ . '/');

require_once BASE_PATH . '../controllers/HomeController.php';

$controller = new HomeController();
$data = $controller->index();

extract($data); 

$about_lab = $about_lab ?? ['isi_konten' => 'Konten Belum Tersedia.', 'image_url' => '/assets/maskot.png'];
$achievement = $achievement ?? [];
$total_achievement = count($achievement);
$personil = $personil ?? [];
$artikel = $artikel ?? [];
$roadmap = $roadmap ?? [];

require_once BASE_PATH . 'layout/header.php';
require_once BASE_PATH . 'layout/navbar.php'; 
?>

<section class="container py-5 text-center">
    <h2 class="fw-bold fs-3">Welcome To</h2>
    <h1 class="fw-bold fs-1">Laboratorium Software Engineering</h1>
    <h1 class="fw-bold text-warning fs-2">Jurusan Teknologi Informasi</h1>
    <br><br>
    <p class="text-light fs-5">“Di Lab Software Engineering, ide menjadi solusi, dan kode menjadi karya. Di sinilah masa depan software dimulai.”</p>
</section>

<hr class="my-5 opacity-25">

<section id="tentang-lab" class="about-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6 text-center">
                <img src="assets/<?php echo htmlspecialchars($about_lab['image_url']); ?>" class="img-fluid maskot-img" alt="Maskot Lab SE">
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="about-card p-5">
                    <h2 class="about-title mb-4 text-center">Tentang Lab</h2>
                    <p class="deskripsi-text">
                        <?php echo nl2br(htmlspecialchars($about_lab['isi_konten'])); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="my-5 opacity-25">

<section class="container py-5">
    <div class="row align-items-center justify-content-center">
        
        <div class="col-md-6 order-md-2">
            <h2 class="fw-bold section-title-flex text-md-start mb-4">Pencapaian</h2>
            
            <div class="achievement-card p-4">
                <ul class="list-unstyled deskripsi-text">
                    <?php if (!empty($achievement)): ?>
                        <?php foreach ($achievement as $a): ?>
                            <li>
                                <i class="bi bi-star-fill text-warning me-2"></i> 
                                <?php echo htmlspecialchars($a['prestasi']); ?>
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
                <?php if (!empty($achievement)): ?>
                    <?php $i = 1; ?>
                    <?php foreach ($achievement as $a): ?>
                        <img 
                            id="sliderImage<?php echo $i; ?>" 
                            src="assets/<?php echo htmlspecialchars($a['image_url']); ?>" 
                            alt="<?php echo htmlspecialchars($a['prestasi']); ?>"
                            <?php if ($i > 1) echo 'style="display:none;"'; // Sembunyikan gambar kedua dst ?>
                        >
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <img id="sliderImage1" src="assets/placeholder.jpg" alt="No Achievement Found">
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<hr class="my-5 opacity-25">

<section id="personil-section" class="team-carousel-section">
    <div class="title-container d-flex justify-content-center align-items-center">
        <img src="assets/our_team.png" class="section-icon" alt="Our Team Icon">
        <h2 class="section-title-flex">OUR TEAM</h2>
    </div>

    <div class="owl-carousel owl-theme">
        <?php if (!empty($personil)): ?>
            <?php foreach ($personil as $p): ?>
                <div class="item">
                    <div class="team-member-card">
                        <img src="<?php echo htmlspecialchars($p['photo_url'] ?? $p['img'] ?? 'personil_default.jpg'); ?>" alt="<?php echo htmlspecialchars($p['nama']); ?>">
                        <div class="team-member-info">
                            <h5><?php echo htmlspecialchars($p['nama']); ?></h5>
                            <p><?php echo htmlspecialchars($p['jabatan']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-light">Data Personil belum tersedia.</p>
        <?php endif; ?>
    </div>
    <a href="personil.php" class="btn btn-data-dosen">Lihat Data Dosen</a>
</section>

<hr class="my-5 opacity-25">

<section id="focus-scope-section" class="container py-5 text-center">
    <h2 class="section-title-flex mb-4">Focus dan Scope Penelitian</h2>
    <div class="row g-4 justify-content-center mt-5">
        
        <?php 
        // Pastikan variabel scopes tersedia
        $scopes = $scopes ?? []; 
        ?>

        <?php if (!empty($scopes)): ?>
            <?php foreach ($scopes as $scope): 
                // 1. Decode JSON (karena Judul disimpan dalam format JSON di kolom isi_konten)
                $data = json_decode($scope['isi_konten'], true);
                
                // 2. Ambil Judul (Gunakan null coalescing operator agar aman)
                $title = $data['title'] ?? 'Judul Tidak Tersedia';
                
                // 3. Ambil Icon (Disimpan di kolom image_url)
                $icon = $scope['image_url'] ?? 'bi-code-slash';
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="icon-box">
                    <i class="bi <?php echo htmlspecialchars($icon); ?> text-warning"></i>
                </div>
                <p class="text-light mt-2"><?php echo htmlspecialchars($title); ?></p>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-light">Data Focus & Scope belum tersedia.</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<hr class="my-5 opacity-25">

<section id="roadmap-section" class="container py-5">
    <h2 class="section-title-flex mb-5 text-center">Roadmap Lab SE</h2>
    <div class="roadmap-timeline clearfix">
        <?php if (!empty($roadmap)): ?>
            <?php foreach ($roadmap as $r): ?>
                <div class="roadmap-item">
                    <div class="card-custom">
                        <h5><?php echo date('Y', strtotime($r['last_updated'])) ?? 'N/A'; ?> - Tahap</h5>
                        <p class="small"><?php echo htmlspecialchars($r['isi_konten']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-light">Data Roadmap belum tersedia.</p>
        <?php endif; ?>
    </div>
</section>

<hr class="my-5 opacity-25">

<section id="blog-section" class="container py-5">
    <h2 class="section-title-flex mb-5 text-center">Blog Artikel Terkini</h2>
    <div class="row g-4 mt-5 pb-5">
        <?php if (!empty($artikel)): ?>
            <?php foreach ($artikel as $a): ?>
                <div class="col-md-4">
                    <div class="blog-card-custom">
                        <div class="blog-card-header"></div>
                        <div class="blog-card-body">
                            <div class="blog-card-meta">
                                <span class="category-tag"><?php echo htmlspecialchars($a['nama_kategori']); ?></span> 
                                <span class="date-info" style="font-size: 0.85rem; color: #4A5568;">
                                    <?php echo date('d/m/Y', strtotime($a['tanggal_publikasi'])); ?>
                                </span>
                            </div>
                            <h5><?php echo htmlspecialchars($a['title']); ?></h5>
                            <p class="snippet"><?php echo htmlspecialchars($a['subtitle']); ?></p>
                            <a href="#" class="read-now">Read Now</a>
                        </div>
                        <div class="blog-card-footer">
                            <i class="bi bi-person-circle"></i>
                            <span class="author-name"><?php echo htmlspecialchars($a['penulis']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-light">Data Artikel belum tersedia.</p>
        <?php endif; ?>
    </div>
    <div class="d-flex justify-content-center">
        <a href="#" class="btn btn-data-dosen">Lihat lebih banyak</a>
    </div>
</section>

<?php
// 6. Render Footer
require_once BASE_PATH . 'layout/footer.php';
?>