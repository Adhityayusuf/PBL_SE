<?php
// 2. KONFIGURASI TAMPILAN
$title = htmlspecialchars($artikel['title']) . " - Lab SE";

$customCSS = "
    body {
        background: #06213D;
        font-family: 'Poppins', sans-serif;
        color: white;
    }

    /* Icon Mobile */
    .navbar-toggler { border-color: rgba(255,255,255,0.5) !important; }
    .navbar-toggler-icon { filter: invert(1) grayscale(100%) brightness(200%); }

    /* Dropdown Menu */
    .dropdown-menu {
        background-color: white !important;
        border-radius: 12px;
        margin-top: 15px;
        border: none;
    }
    .dropdown-item { color: #06213D !important; font-weight: 500; }
    .dropdown-item:hover { background-color: #f0f0f0 !important; color: #0863C7 !important; }

    /* === STYLE KHUSUS KONTEN ARTIKEL === */
    .article-container {
        padding-top: 20px; 
        padding-bottom: 80px;
        max-width: 900px; /* Lebar konten bacaan agar nyaman */
        margin: 0 auto;
    }

    /* Kategori Label */
    .category-tag {
        background: #FFC107;
        padding: 6px 16px;
        color: #06213D;
        display: inline-block;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Judul Artikel */
    h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    /* Info Penulis */
    .author-meta {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
        padding-bottom: 20px;
    }
    .author-icon {
        width: 45px;
        height: 45px;
        background: white;
        border-radius: 50%;
        color: #06213D;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-right: 15px;
    }
    .author-info {
        font-size: 0.9rem;
    }
    .author-name { font-weight: 700; color: white; display: block; }
    .publish-date { color: #a0aec0; }

    /* Hero Image */
    .hero-section {
        width: 100%;
        height: 450px;
        background-color: rgba(255,255,255,0.1);
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    .hero-img {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
    }

    /* Isi Konten */
    .content-body {
        line-height: 1.9;
        color: #e4e4e4;
        font-size: 1.1rem;
        text-align: justify;
    }
    .content-body p { margin-bottom: 25px; }

    /* Tombol Kembali */
    .back-container {
        margin-top: 60px;
        text-align: center;
    }
    .back-btn {
        padding: 12px 35px;
        background: transparent;
        color: white;
        border: 2px solid white;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
    }
    .back-btn:hover {
        background: white;
        color: #06213D;
        transform: translateY(-3px);
    }
";

// 3. INCLUDE HEADER & NAVBAR (URUTAN PENTING)
require_once __DIR__ . '/layout/header.php';

// Include Navbar DI LUAR container artikel agar full width
include __DIR__ . '/layout/navbar.php'; 
?>

<div class="container article-container">
    
    <div class="text-center">
        <span class="category-tag">
            <?= htmlspecialchars($artikel['nama_kategori'] ?? 'Umum') ?>
        </span>
    </div>

    <h1 class="text-center"><?= htmlspecialchars($artikel['title']) ?></h1>

    <p class="text-center text-light mb-4" style="opacity: 0.8; font-size: 1.1rem;">
        <?= htmlspecialchars($artikel['subtitle']) ?>
    </p>

    <div class="d-flex justify-content-center">
        <div class="author-meta border-0">
            <div class="author-icon">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="author-info text-start">
                <span class="author-name"><?= htmlspecialchars($artikel['penulis']) ?></span>
                <span class="publish-date"><?= date('d F Y', strtotime($artikel['tanggal_publikasi'])) ?></span>
            </div>
        </div>
    </div>

    <div class="hero-section">
        <?php $bgImage = !empty($artikel['image_url']) ? $artikel['image_url'] : 'assets/bg.png'; ?>
        <div class="hero-img" style="background-image: url('<?= htmlspecialchars($bgImage) ?>');"></div>
    </div>

    <div class="content-body">
        <?= nl2br(htmlspecialchars($artikel['isi_konten'])) ?>
    </div>

    <div class="back-container">
        <a href="/index.php?action=blog" class="back-btn">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Blog
        </a>
    </div>

</div>

<?php include __DIR__ . '/layout/footer.php'; ?>