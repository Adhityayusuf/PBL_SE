<?php
// 2. KONFIGURASI TAMPILAN
$title = "Blog Artikel - Lab SE";

$customCSS = "
    body {
        background: #06315A;
        font-family: 'Poppins', sans-serif;
        color: white;
    }

    /* Dropdown Menu */
    .dropdown-menu {
        background-color: white !important;
        border-radius: 12px;
        margin-top: 15px;
        border: none;
    }
    .dropdown-item { color: #06213D !important; font-weight: 500; }
    .dropdown-item:hover { background-color: #f0f0f0 !important; color: #0863C7 !important; }

    /* === HEADER & FILTER === */
    .blog-header {
        margin-top: 40px; /* Jarak dari navbar */
        margin-bottom: 40px;
        color: white;
    }

    .filter-btn {
        border-radius: 20px;
        text-decoration: none;
        padding: 8px 20px;
        display: inline-block;
        transition: all 0.3s;
    }
    .btn-active {
        background-color: #f8f9fa;
        color: #000;
        border: 1px solid #f8f9fa;
        font-weight: 700;
    }
    .btn-inactive {
        background-color: transparent;
        color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.4);
    }
    .btn-inactive:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        border-color: white;
    }

    /* Input Search */
    input[name='search'] {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
    }
    input[name='search']::placeholder { color: rgba(255, 255, 255, 0.6); }
    input[name='search']:focus {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        border-color: white;
        box-shadow: none;
    }

    /* CARD STYLES */
    .blog-card-custom {
        background-color: #F8F8F8;
        border-radius: 15px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        color: #06315A;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .blog-card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    .blog-card-header {
        height: 180px;
        background-size: cover;
        background-position: center;
    }
    .blog-card-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .category-tag {
        background-color: #06315A;
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 6px;
    }
    .blog-card-footer {
        padding: 15px 20px;
        border-top: 1px solid #E2E8F0;
        background-color: white;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .author-name {
        color: #4A5568;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .read-now {
        margin-top: auto;
        color: #06315A;
        font-weight: 600;
        text-decoration: none;
    }
    .read-now:hover { text-decoration: underline; color: #0863C7; }
";

// 3. INCLUDE HEADER & NAVBAR
require_once __DIR__ . '/layout/header.php';

// === PERBAIKAN: Navbar ditaruh DI LUAR Container Blog Header ===
include __DIR__ . '/layout/navbar.php'; 
?>

<div class="container blog-header">
    
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <div class="mb-3">
            <h1 class="fw-bold display-5">Blog Artikel</h1>
            <p class="lead" style="opacity: 0.9; font-size: 1.1rem;">
                Temukan wawasan terbaru seputar teknologi, tutorial koding, dan update kegiatan dari Lab Software Engineering.
            </p>
        </div>
        <img src="/Views/assets/maskot.png" alt="Mascot" style="width:180px; transform: scaleX(-1); filter: drop-shadow(0 5px 15px rgba(0,0,0,0.3));">
    </div>

    <div class="d-flex align-items-center gap-2 mt-4 flex-wrap">
        <a href="/index.php?action=blog&kategori=all"
            class="filter-btn <?= $filterKategori === 'all' ? 'btn-active' : 'btn-inactive' ?>">
            All Article
        </a>

        <?php foreach ($kategoriList as $kat): ?>
            <a href="/index.php?action=blog&kategori=<?= $kat['id_kategori'] ?>"
                class="filter-btn <?= $filterKategori == $kat['id_kategori'] ? 'btn-active' : 'btn-inactive' ?>">
                <?= htmlspecialchars($kat['nama']) ?>
            </a>
        <?php endforeach; ?>

        <form action="/index.php" method="GET" class="ms-auto mt-2 mt-md-0">
            <input type="hidden" name="action" value="blog">
            <input type="text" name="search" placeholder="Search..." class="form-control px-4 py-2" style="border-radius: 30px;" value="<?= htmlspecialchars($searchKeyword ?? '') ?>">
        </form>
    </div>
</div>

<section id="blog-section" class="container pb-5">
    <div class="row g-4">
        <?php if (empty($artikelList)): ?>
            <div class="col-12 text-center py-5">
                <div style="background: rgba(255,255,255,0.05); padding: 40px; border-radius: 20px;">
                    <i class="bi bi-journal-x" style="font-size: 3rem; opacity: 0.5;"></i>
                    <h4 class="mt-3 text-white-50">Tidak ada artikel ditemukan.</h4>
                    <a href="/index.php?action=blog&kategori=all" class="btn btn-outline-light mt-3">Reset Filter</a>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($artikelList as $row): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="blog-card-custom">
                        <?php $bgImage = !empty($row['image_url']) ? $row['image_url'] : '/assets/acv1.jpg'; ?>
                        <div class="blog-card-header" style="background-image: url('<?= htmlspecialchars($bgImage) ?>');"></div>
                        
                        <div class="blog-card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="category-tag">
                                    <?= htmlspecialchars($row['nama_kategori'] ?? 'Umum') ?>
                                </span>
                                <small style="color: #4A5568;">
                                    <?= date('d/m/Y', strtotime($row['tanggal_publikasi'])) ?>
                                </small>
                            </div>

                            <h5 class="fw-bold mb-2"><?= htmlspecialchars($row['title']) ?></h5>
                            <p class="small text-muted flex-grow-1">
                                <?= htmlspecialchars($row['subtitle']) ?>
                            </p>

                            <a href="/index.php?action=artikel&id=<?= $row['id_artikel'] ?>" class="read-now">Read Now</a>
                        </div>

                        <div class="blog-card-footer">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span class="author-name"><?= htmlspecialchars($row['penulis']) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/layout/footer.php'; ?>