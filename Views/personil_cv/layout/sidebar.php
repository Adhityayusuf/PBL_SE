<?php
    $currentAction = $_GET['action'] ?? 'dashboard';
?>


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
        position: fixed;
        top: 20px;
        left: 20px;
        width: 250px;

        height: calc(100vh - 40px);

        background: #ffffff;
        padding: 28px 20px;
        border-radius: 10px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .15);
        font-family: 'Poppins', sans-serif;

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
    .cv-link:hover,
    .cv-link.active {
        background: #0b3b66;
        color: #fff;
    }

    .cv-link:hover i,
    .cv-link.active i {
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
        min-height: calc(100vh - 40px);
        padding-left: 40px 50px;
        margin-left: 200px;
        gap: 20px;
        height: calc(100vh);
    }

    /* Content elements inside wrapper */
    .content-wrapper h1 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 30px;
        color: #333;
    }

    /* ===== GRID & CARD PENELITIAN (Sesuai Screenshot) ===== */

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

        <div class="cv-title">Portofolio Dosen</div>

        <ul class="cv-menu">
            <li>
                <a href="index.php?action=dashboard&id=<?= htmlspecialchars($id_personil) ?>"
                    class="cv-link <?= ($currentAction === 'dashboard') ? 'active' : '' ?>">
                    <i class="bi bi-grid"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="index.php?action=identitas&id=<?= htmlspecialchars($id_personil) ?>"
                    class="cv-link <?= ($currentAction === 'identitas') ? 'active' : '' ?>">
                    <i class="bi bi-person"></i> Identitas Diri
                </a>
            </li>

            <li>
                <a href="index.php?action=riwayat&id=<?= htmlspecialchars($id_personil) ?>"
                    class="cv-link <?= ($currentAction === 'riwayat') ? 'active' : '' ?>">
                    <i class="bi bi-mortarboard"></i> Riwayat Pendidikan
                </a>
            </li>

            <li>
                <a href="index.php?action=penelitian&id=<?= htmlspecialchars($id_personil) ?>"
                    class="cv-link <?= ($currentAction === 'penelitian') ? 'active' : '' ?>">
                    <i class="bi bi-people"></i> Penelitian
                </a>
            </li>

            <li>
                <a href="index.php?action=pengabdian&id=<?= htmlspecialchars($id_personil) ?>"
                    class="cv-link <?= ($currentAction === 'pengabdian') ? 'active' : '' ?>">
                    <i class="bi bi-journal-text"></i> Pengabdian
                </a>
            </li>

            <li>
                <a href="index.php?action=buku&id=<?= htmlspecialchars($id_personil) ?>"
                    class="cv-link <?= ($currentAction === 'buku') ? 'active' : '' ?>">
                    <i class="bi bi-book"></i> Karya Buku
                </a>
            </li>

            <li>
                <a href="index.php?action=hki&id=<?= htmlspecialchars($id_personil) ?>"
                    class="cv-link <?= ($currentAction === 'hki') ? 'active' : '' ?>">
                    <i class="bi bi-award"></i> Perolehan HKI
                </a>
            </li>

        </ul>

    </div>
</div>