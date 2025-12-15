<?php
$customCSS = " 
        /* ===== RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ===== BODY ===== */
        body {
            font-family: 'Poppins', sans-serif;
            background: #0a2647;
            min-height: 100vh;
        }

        .layout {
            display: flex;
            min-height: 100vh; 
            padding: 20px; /* Tambahkan padding di sini (seperti layout sidebar) */
            gap: 20px; /* Jarak antara Sidebar dan Konten */
        }

        /* ===== LAYOUT ===== */
        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        
        .card {
            background: #fff;
            border-radius: 10px; /* Diperkecil agar lebih elegan */
            padding: 50px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3); /* Shadow lebih kuat */
            width: 90%; /* Memastikan lebar kartu 100% dikurangi margin */
            margin: 20px 0;
            min-height: auto;
        }

        /* ===== HEADER ===== */
        .card h1 {
            font-size: 28px;
            margin-bottom: 40px;
            color: #333;
        }

        /* ===== GRID LAYOUT ===== */
        .pengabdian-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        /* ===== PENGABDIAN ITEM ===== */
        .pengabdian-item {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            /* Flexbox agar tombol bisa didorong ke bawah (opsional) */
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }

        .pengabdian-item:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
        }

        /* ===== YEAR ===== */
        .pengabdian-item .year {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        /* ===== CONTENT ===== */
        .pengabdian-item .info {
            margin-bottom: 12px;
        }

        .pengabdian-item .label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .pengabdian-item .value {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        /* ===== 2. CSS TOMBOL LIHAT (MODIFIKASI BARU) ===== */
        .btn-lihat {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #0b3b66;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-top: auto; /* Penting untuk dorong tombol ke bawah */
            width: fit-content;
            transition: background 0.3s ease;
        }

        .btn-lihat:hover {
            background-color: #1a5f8a;
        }

        .btn-lihat i {
            font-size: 12px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .card {
                padding: 30px 20px;
            }

            .card h1 {
                font-size: 24px;
                margin-bottom: 30px;
            }

            .pengabdian-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .pengabdian-item {
                padding: 20px;
            }

            .pengabdian-item .year {
                font-size: 20px;
            }
        }";

include __DIR__ . '/layout/header.php'
?>

<div class="layout">
    <?php include __DIR__ . '/layout/sidebar.php' ?>
    <div class="main-content">
        <div class="content-wrapper">

            <div class="container">

                <div class="card">
                    <h2>Pengalaman Pengabdian</h2>
                    <div class="pengabdian-grid">
                        <?php if (!empty($pengabdian)) : ?>
                            <?php foreach ($pengabdian as $item): ?>
                                <div class="pengabdian-item">
                                    <div class="year"><?= htmlspecialchars($item['tahun'] ?? '-') ?></div>
                                    <div class="info">
                                        <span class="label">Judul</span>
                                        <span class="value"><?= htmlspecialchars($item['judul_pengabdian'] ?? '-') ?></span>
                                    </div>
                                    <div class="info">
                                        <span class="label">Sumber Dana</span>
                                        <span class="value"><?= htmlspecialchars($item['sumber_dana'] ?? '-') ?></span>
                                    </div>
                                    <div class="info">
                                        <span class="label">Jumlah</span>
                                        <span class="value"><?= htmlspecialchars($item['jml_dana'] ?? '-') ?></span>
                                    </div>

                                    <a href="<?= htmlspecialchars($item['link'] ?? '-') ?>" class="btn-lihat">
                                        Lihat <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">Belum ada data pengabdian.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>