<?php
$customCSS = "
/* ===== RESET & BODY ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-color: #0a2647;
    font-family: 'Poppins', sans-serif;
}

/* ===== CONTAINER ===== */
.container {
    max-width: 1400px;
    margin: 0 auto;
}

/* ===== MAIN BOX ===== */
.main-container {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 35px;
    margin: 0px 50px 50px 69px;
    max-width: 1092px; /* ⬅️ ATUR LEBAR DI SINI */
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

/* ===== TITLE ===== */
.section-title {
    font-weight: 700;
    font-size: 24px;
    margin-bottom: 30px;
    color: #000;
}

/* ===== HKI CARD ===== */
.hki-card {
    width: 100%;              /* ⬅️ FULL CONTAINER */
    min-height: 90px;         /* ⬅️ ATUR TINGGI CARD */
    
    display: flex;
    justify-content: space-between;
    align-items: center;

    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px 25px;
    margin-bottom: 20px;

    box-shadow: 0 2px 4px rgba(0,0,0,0.18);
    transition: all 0.3s ease;
}

.hki-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #adb5bd;
}

/* ===== HKI CONTENT ===== */
.hki-content {
    padding-right: 20px;
    flex: 1;
}

/* ===== JUDUL HKI ===== */
.hki-title {
    font-size: 16px;
    font-weight: 700;
    color: #212529;
    margin-bottom: 5px;

    display: -webkit-box;
    -webkit-line-clamp: 2;    /* ⬅️ MAKS 2 BARIS */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* ===== NOMOR ===== */
.hki-number {
    font-size: 13px;
    color: #6c757d;
}

/* ===== LABEL KANAN ===== */
.label-type {
    background-color: #0f3460;
    color: white;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 20px;
    border-radius: 5px;
    white-space: nowrap;
    flex-shrink: 0;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .main-container {
        margin: 20px;
        padding: 25px;
    }

    .hki-card {
        flex-direction: column;
        align-items: flex-start;
        min-height: auto;
    }

    .hki-content {
        padding-right: 0;
        margin-bottom: 15px;
    }

    .label-type {
        width: 100%;
        text-align: center;
    }
}
";

include __DIR__ . '/layout/header.php';
?>

<div class="layout">
    <?php include __DIR__ . '/layout/sidebar.php'; ?>

    <div class="main-content">
        <div class="content-wrapper">
            <div class="container">
                <div class="main-container">

                    <h2 class="section-title">Perolehan HKI</h2>

                    <?php if (!empty($hki)): ?>
                        <?php foreach ($hki as $row): ?>
                            <div class="hki-card">

                                <div class="hki-content">
                                    <div class="hki-title">
                                        <?= htmlspecialchars($row['judul']); ?> (<?= htmlspecialchars($row['tahun']); ?>)
                                    </div>
                                    <p class="hki-number">
                                        Nomor P/ID : <?= htmlspecialchars($row['no_pdd']); ?>
                                    </p>
                                </div>

                                <div class="label-type">
                                    <?= htmlspecialchars($row['jenis']); ?>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada data HKI.</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
