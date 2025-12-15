<?php
$title = 'Penelitian';

$customCSS = "* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #0a2647; /* Latar belakang body (luar Sidebar & Konten Putih) */
            min-height: 100vh;
        }

        /* ===== MAIN LAYOUT (Flexbox untuk Sidebar dan Konten) ===== */
        .layout {
                display: flex;
                min-height: 100vh; 
                padding: 20px; /* Tambahkan padding di sini (seperti layout sidebar) */
                gap: 20px; /* Jarak antara Sidebar dan Konten */
            }

        /*
        |--------------------------------------------------------------------------
        | CONTENT STYLES
        |--------------------------------------------------------------------------
        */
        .content {
            flex: 1; /* Mengisi sisa ruang */
            padding: 0; /* Hapus padding di sini */
            /* Latar belakang konten (area di luar card putih) sama dengan body */
            background: #0a2647; 
            overflow: auto; /* Penting jika konten penelitian sangat panjang */
        }

        /* Container tidak terlalu dibutuhkan jika tidak ada batas lebar */
        .container {
            width: 100%;
            max-width: 100%;
        }

        /* Card adalah Kotak Putih dengan Shadow */
        .card {
            background: #fff;
            border-radius: 10px; /* Diperkecil agar lebih elegan */
            padding: 50px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3); /* Shadow lebih kuat */
            margin-top: 20px; 
            width: 90%; /* Memastikan lebar kartu 100% dikurangi margin */
            min-height: calc(100vh - 60px); /* Agar kartu setinggi layar dikurangi margin atas/bawah */
        }

        /* ===== HEADER & GRID LAYOUT (Tetap Sama) ===== */
        .card h1 {
            font-size: 28px;
            margin-bottom: 40px;
            color: #333;
        }

        .penelitian-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); /* Auto-fit lebih fleksibel */
            gap: 30px;
        }

        /* Sisa gaya penelitian-item, btn-lihat, dan responsive tetap sama... */
        .penelitian-item {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .penelitian-item:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
        }

        .penelitian-item .year {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .penelitian-item .info {
            margin-bottom: 12px;
        }

        .penelitian-item .label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .penelitian-item .value {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

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
        @media (max-width: 900px) {
            .penelitian-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 768px) {
            .layout {
                flex-direction: column; /* Sidebar di atas, konten di bawah */
            }
            .sidebar {
                width: 100%;
                min-height: auto;
            }
            .card {
                margin: 20px;
                padding: 30px 20px;
                width: calc(100% - 40px);
                min-height: auto;
            }
        }";

include __DIR__ . '/layout/header.php';
?>


<div class="layout">

    <?php include __DIR__ . '/layout/sidebar.php'; ?>

    <div class="content">
        <div class="container">
            <div class="card">
                <h2>Pengalaman Penelitian</h2>
                <div class="penelitian-grid">
                    <?php if (!empty($penelitian)): ?>
                        <?php foreach ($penelitian as $item): ?>
                            <div class="penelitian-item">
                                <div class="year"><?= htmlspecialchars($item['tahun'] ?? '-') ?></div>
                                <div class="info">
                                    <span class="label">Judul</span>
                                    <span class="value"><?= htmlspecialchars($item['judul_penelitian'] ?? '-') ?></span>
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
                        <p class="text-muted">Belum ada data penelitian.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>