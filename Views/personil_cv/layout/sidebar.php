<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* ===== RESET & BODY ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: #0a2647;
        /* Latar Belakang Biru Tua */
        min-height: 100vh;
    }

    /* ===== MAIN LAYOUT (Flexbox) ===== */
    .layout {
        display: flex;
        min-height: 100vh;
        padding: 20px;
        /* Padding luar agar Sidebar dan Konten tidak menempel ke tepi browser */
    }

    /*
        |--------------------------------------------------------------------------
        | SIDEBAR STYLES (Panel Putih Kiri - Disesuaikan dengan Screenshot)
        |--------------------------------------------------------------------------
        */
    .sidebar-cv {
        width: 250px;
        /* Lebar Sidebar disesuaikan */
        min-height: calc(100vh - 40px);
        /* Setinggi layar dikurangi padding layout */
        background: #ffffff;
        padding: 28px 20px;
        border-radius: 10px;
        /* Disesuaikan agar seragam dengan konten */
        box-shadow: 0 8px 25px rgba(0, 0, 0, .15);
        /* Shadow sedang */
        font-family: 'Poppins', sans-serif;
        margin-right: 20px;
        /* Jarak antara Sidebar dan Konten */
        flex-shrink: 0;
    }

    /* ===== TITLE (Sesuai Screenshot - Rata Kiri) ===== */
    .sidebar-cv .cv-title {
        font-size: 20px;
        font-weight: 700;
        text-align: left;
        margin-bottom: 25px;
        letter-spacing: normal;
    }

    /* ===== MENU & LINKS ===== */
    .cv-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .cv-menu li {
        margin-bottom: 5px;
        /* Jarak antar item lebih kecil */
    }

    .cv-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 10px;
        border-radius: 6px;
        color: #333;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all .25s ease;
    }

    .cv-link i {
        font-size: 14px;
        width: 18px;
        text-align: center;
        color: #444;
    }

    /* Hover */
    .cv-link:hover {
        background: #0b3b66;
        color: #fff;
    }

    /* Active: Biru Tua untuk latar belakang aktif */
    .cv-link.active {
        background: #0b3b66;
        color: #fff;
    }

    .cv-link.active i {
        color: #fff;
    }

    /*
        |--------------------------------------------------------------------------
        | CONTENT STYLES (Panel Putih Kanan - Sesuai Screenshot)
        |--------------------------------------------------------------------------
        */
    .content-wrapper {
        flex: 1;
        /* Mengisi sisa ruang */
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .15);
        min-height: calc(100vh - 40px);
        /* Setinggi layar dikurangi padding layout */
        padding: 40px 50px;
        /* Padding di dalam kotak konten */
        overflow: auto;
        /* Agar konten bisa di-scroll jika panjang */
    }

    /* Content elements inside wrapper */
    .content-wrapper h1 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 30px;
        color: #333;
    }

    /* ===== GRID & CARD PENELITIAN (Sesuai Screenshot) ===== */
    .penelitian-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 20px;
    }

    .penelitian-item {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
    }

    .penelitian-item:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .penelitian-item .year {
        font-size: 20px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }

    .penelitian-item .info {
        margin-bottom: 5px;
    }

    .penelitian-item .label {
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .penelitian-item .value {
        color: #444;
        font-size: 14px;
        line-height: 1.4;
    }

    .btn-lihat {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #0b3b66;
        color: white;
        padding: 8px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        margin-top: 15px;
        width: fit-content;
        transition: background 0.3s ease;
    }

    .btn-lihat:hover {
        background-color: #1a5f8a;
    }

    .btn-lihat i {
        font-size: 10px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
        .penelitian-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .layout {
            flex-direction: column;
            padding: 10px;
        }

        .sidebar-cv {
            width: 100%;
            min-height: auto;
            margin-right: 0;
            margin-bottom: 15px;
        }

        .content-wrapper {
            min-height: auto;
            padding: 30px 20px;
        }
    }
</style>

<div class="layout">


    <div class="sidebar-cv">

        <div class="cv-title">PROFILE CV</div>

        <ul class="cv-menu">
            <li>
                <a href="/index.php?action=dashboard&id=<?= htmlspecialchars($id_personil) ?>" class="cv-link active">
                    <i class="bi bi-grid"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="index.php?action=identitas&id=<?= htmlspecialchars($id_personil) ?>" class="cv-link ">
                    <i class="bi bi-grid"></i> Identitas Diri
                </a>
            </li>

            <li>
                <a href="index.php?action=riwayat&id=<?= htmlspecialchars($id_personil) ?>" class="cv-link">
                    <i class="bi bi-lightning-charge"></i> Riwayat Pendidikan
                </a>
            </li>

            <li>
                <a href="index.php?penelitian&id=<?= htmlspecialchars($id_personil) ?>" class="cv-link">
                    <i class="bi bi-people"></i> Penelitian
                </a>
            </li>

            <li>
                <a href="index.php?action=pengabdian&id=<?= htmlspecialchars($id_personil) ?>" class="cv-link">
                    <i class="bi bi-journal-text"></i> Pengabdian
                </a>
            </li>

            <li>
                <a href="index.php?action=buku&id=<?= htmlspecialchars($id_personil) ?>" class="cv-link">
                    <i class="bi bi-journal-text"></i> Karya Buku
                </a>
            </li>

            <li>
                <a href="index.php?hki&id=<?= htmlspecialchars($id_personil) ?>" class="cv-link">
                    <i class="bi bi-award"></i> Perolehan HKI
                </a>
            </li>

        </ul>

    </div>
</div>