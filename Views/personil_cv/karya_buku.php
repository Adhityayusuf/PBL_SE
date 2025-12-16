<?php
$customCSS = "
/* ===== BODY ===== */
body {
    background-color: #0a2647;
    font-family: 'Poppins', sans-serif;
}

/* ===== MAIN CONTAINER ===== */
.main-container {
    background-color: white;
    border-radius: 10px;
    padding: 35px;
    margin: 0px 50px 50px 69px;
    max-width: 1400px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

/* ===== TITLE ===== */
.section-title {
    font-weight: 700;
    font-size: 28px;
    margin-bottom: 40px;
    color: #000;
}

/* ===== TIMELINE ===== */
.timeline-left {
    position: relative;
    padding-left: 60px;
    display: flex;
    flex-direction: column;
    gap: 30px;
}

/* GARIS TIMELINE (DINAMIS) */
.timeline-left::before {
    content: '';
    position: absolute;
    left: 24px;
    top: 12px;
    height: calc(100% - 24px); /* ✅ ikut tinggi konten */
    width: 4px;
    background-color: #adb5bd;
    border-radius: 2px;
}

/* ===== ITEM ===== */
.timeline-item {
    position: relative;
    display: flex;
    align-items: flex-start;
    animation: fadeIn 0.5s ease-in-out;
}

/* ===== DOT ===== */
.timeline-dot {
    position: absolute;
    left: -45px;
    top: 100px; /* ✅ sejajar dengan card */
    width: 20px;
    height: 20px;
    background-color: #ffc107;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 1px #adb5bd;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

/* DOT HOVER */
.timeline-item:hover .timeline-dot {
    transform: scale(1.3);
    background-color: #ffaa00;
    box-shadow: 0 0 0 4px #adb5bd;
}

/* ===== CARD ===== */
.book-card {
    width: 100%;
    width: 953px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 25px;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    transition: 0.3s;
}

.book-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateX(5px);
}

/* ===== CONTENT ===== */
.year-badge {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #212529;
}

.book-detail {
    font-size: 14px;
    color: #444;
    margin-bottom: 6px;
    line-height: 1.5;
}

.book-detail strong {
    color: #000;
    font-weight: 700;
}

/* ===== BUTTON ===== */
.btn-lihat {
    background-color: #0f3460;
    color: white;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 25px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    margin-top: 15px;
    transition: background 0.3s;
}

.btn-lihat:hover {
    background-color: #1a4a85;
}

/* ===== ANIMATION ===== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .main-container {
        margin: 20px;
        padding: 25px;
    }

    .timeline-left {
        padding-left: 45px;
    }

    .timeline-left::before {
        left: 18px;
    }

    .timeline-dot {
        left: -35px;
        width: 16px;
        height: 16px;
        top: 20px;
    }
}";
include __DIR__ . '/layout/header.php';
?>

<div class="layout">
    <?php include __DIR__ . '/layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="content-wrapper">
            <div class="container">

                <div class="main-container">
                    <h2>Karya Buku</h2>
                    <br>
                    <div class="timeline-left">
                        <?php if (!empty($buku)): ?>
                            <?php foreach ($buku as $item): ?>
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>

                                    <div class="book-card">
                                        <div class="year-badge"><?= htmlspecialchars($item['tahun']) ?></div>
                                        <div class="book-detail"><strong>Judul:</strong> <?= htmlspecialchars($item['judul']) ?></div>
                                        <div class="book-detail"><strong>Penerbit:</strong> <?= htmlspecialchars($item['penerbit']) ?></div>
                                        <div class="book-detail"><strong>Halaman:</strong> <?= htmlspecialchars($item['halaman']) ?></div>
                                        <a href="<?= htmlspecialchars($item['link'] ?? '#')?>" class="btn-lihat">Lihat</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Belum ada data buku.</p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>