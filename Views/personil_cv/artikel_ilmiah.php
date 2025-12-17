<?php
$customCSS = "
/* ===== HALAMAN ARTIKEL ===== */
.main-content {
    margin-left: 290px; /* KUNCI: offset sidebar fixed */
    max-width: 1400;
}

.main-container {
    width: 100%;
    background-color: #ffffff;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    margin-bottom: 50px;
    margin-right: 240px;
}

.section-title {
    font-weight: 700;
    font-size: 28px;
    margin-bottom: 40px;
    color: #000;
}

/* ===== CARD ===== */
.article-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    background: #fff;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    position: relative;
    transition: all 0.3s ease;
    z-index: 2;
}

.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    border-color: #0f3460;
}

.year-text {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 10px;
}

.article-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 10px;
}

.journal-name {
    font-size: 12px;
    color: #666;
    margin-bottom: 15px;
}

.btn-lihat {
    background-color: #0f3460;
    color: white;
    font-size: 12px;
    font-weight: 600;
    padding: 8px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-lihat:hover {
    background-color: #16213e;
    color: #fff;
}

/* ===== TIMELINE ===== */
.timeline-wrapper {
    position: relative;
}

.timeline-line {
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 4px;
    background-color: #adb5bd;
    transform: translateX(-50%);
    border-radius: 2px;
    z-index: 0;
}

.col-center {
    display: flex;
    align-items: center;
    justify-content: center;
}

.timeline-dot {
    width: 20px;
    height: 20px;
    background-color: #ffc107;
    border-radius: 50%;
    box-shadow: 0 0 0 4px #fff;
    z-index: 1;
    transition: all 0.3s ease;
}

.timeline-row:hover .timeline-dot {
    transform: scale(1.5);
    background-color: #ffaa00;
    box-shadow: 0 0 0 6px #fff;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .main-content {
        margin-left: 0;
    }

    .timeline-line,
    .col-center {
        display: none;
    }

    .article-card {
        margin-bottom: 20px;
    }
}
";

include __DIR__ . '/layout/header.php';
?>

<div class="layout">
    <?php include __DIR__ . '/layout/sidebar.php'; ?>

    <div class="main-content">
        <div class="main-container">
            <h2 class="section-title">Artikel Ilmiah</h2>

            <div class="timeline-wrapper">
                <?php $totalItem = count($artikel); ?>
                <?php if ($totalItem > 3) : ?>
                    <div class="timeline-line"></div>
                <?php endif; ?>
                <?php if (!empty($artikel)) : ?>

                    <?php foreach ($artikel as $item): ?>
                        <div class="row mb-5 timeline-row">
                            <div class="col-md-5">
                                <div class="article-card">
                                    <div class="year-text"><?= htmlspecialchars($item['tahun'] ?? '') ?></div>
                                    <div class="article-title"><?= htmlspecialchars($item['judul'] ?? '') ?></div>
                                    <div class="journal-name"><?= htmlspecialchars($item['nama_jurnal'] ?? '') ?></div>
                                    <a href="<?= htmlspecialchars($item['link'] ?? '#') ?>" class="btn-lihat">
                                        Lihat <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-2 col-center">
                                <?php if ($totalItem > 3) : ?>
                                    <div class="timeline-dot"></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-5"></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Belum ada data artikel.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>