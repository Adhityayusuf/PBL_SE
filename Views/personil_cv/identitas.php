<?php
$customCSS = "
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
            padding: 0px 0px 20px;
        }

        /* ===== LAYOUT ===== */
        .container {
            max-width: 100%;
            max-height: 50%;
            margin: 0 auto;
        }

        .card {
            background: #ffffffff;
            border-radius: 20px;
            padding: 100px;
            margin-top: 20px;
            margin-bottom: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        /* ===== HEADER ===== */
        .card h1 {
            font-size: 28px;
            margin-bottom: 40px;
            color: #333;
            font-weight: 700;
        }

        /* ===== CONTENT LAYOUT ===== */
        .content-wrapper {
            display: flex;
            gap: 40px;
        }

        /* ===== FOTO PROFIL ===== */
        .foto-section {
            flex-shrink: 0;
        }

        .foto-profil {
            width: 270px;
            height: 380px;
            border-radius: 10px;
            flex-shrink: 0;
            object-fit: cover;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15); 
            transition: transform 0.3s ease;
            display: block;
        }

        .foto-profil:hover {
            transform: scale(1.02);
        }

        /* ===== INFO SECTION ===== */
        .info-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* ===== INFO BOX STYLE (MODIFIED: WHITE THEME) ===== */
        .info-box, .lulusan-box, .matkul-box {
            background: #ffffff; /* Ubah jadi Putih */
            border: 1px solid #e0e0e0; /* Tambah border abu tipis */
            border-radius: 12px;
            padding: 20px 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.18); /* Shadow halus */
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .info-box:hover, .lulusan-box:hover, .matkul-box:hover {
            transform: translateY(-5px);
            border-color: #0b4f7a; /* Border jadi biru saat hover */
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .info-box label, .lulusan-box label, .matkul-box label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0a2647;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .info-box .value {
            font-size: 15px;
            font-weight: 600;
            color: #333333; /* Ubah isi jadi Hitam Gelap */
        }

        /* ===== GRID LAYOUTS ===== */
        .info-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .info-row-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .info-row-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }

        /* ===== LULUSAN SECTION ===== */
        .lulusan-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            text-align: center;
        }

        .lulusan-item {
            background: #f8f9fa; /* Abu sangat muda */
            border-radius: 10px;
            padding: 10px;
            transition: background 0.3s;
            border: 1px solid #eee;
        }

        .lulusan-item:hover {
            background: #e9ecef;
        }

        .lulusan-item h3 {
            font-size: 14px;
            color: #666; /* Abu gelap */
            margin-bottom: 5px;
        }

        .lulusan-item p {
            font-size: 22px;
            font-weight: 700;
            color: #0b4f7a; /* Angka Biru Tua */
            margin: 0;
        }

        /* ===== MATA KULIAH SECTION ===== */
        .matkul-list {
            list-style: none;
        }

        .matkul-list li {
            font-size: 15px;
            color: #333; /* Teks Hitam */
            margin-bottom: 8px;
            padding: 8px 0;
            border-bottom: 1px solid #eee; /* Garis pemisah abu */
            transition: transform 0.2s ease, color 0.2s ease;
            cursor: default;
        }
        
        .matkul-list li:last-child {
            border-bottom: none;
        }

        .matkul-list li:hover {
            transform: translateX(10px);
            color: #0b4f7a; /* Hover jadi Biru */
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .content-wrapper { flex-direction: column; }
            .foto-section { margin: 0 auto 30px auto; }
            .info-row-4 { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .card { padding: 30px 20px; }
            .card h1 { font-size: 24px; margin-bottom: 30px; }
            .info-row, .info-row-3, .info-row-4 { grid-template-columns: 1fr; }
            .lulusan-grid { gap: 10px; }
        }";

include __DIR__ . '/layout/header.php';
?>

<div class="layout">
    <?php include __DIR__ . '/layout/sidebar.php' ?>
    <div class="main-content">
        <div class="content-wrapper">

            <div class="container">
                <div class="card">
                    <h1>Identitas Diri</h1>

                    <!-- FOTO -->
                    <!-- <div class="foto-section">
                        <img
                            src="< htmlspecialchars($personil['photo_url']) ?>"
                            alt="Foto Profil"
                            class="foto-profil">
                    </div>
                    -->

                    <div class="info-section">
                        <!-- ROW 1 -->
                        <div class="info-row-3">
                            <div class="info-box">
                                <label>Nama Lengkap</label>
                                <div class="value"><?= htmlspecialchars($personil['nama']) ?></div>
                            </div>

                            <div class="info-box">
                                <label>Jabatan Fungsional</label>
                                <div class="value"><?= htmlspecialchars($personil['jabatan']) ?></div>
                            </div>

                            <div class="info-box">
                                <label>Nomor Induk Pegawai</label>
                                <div class="value"><?= htmlspecialchars($personil['nip']) ?></div>
                            </div>
                        </div>

                        <!-- ROW 2 -->
                        <div class="info-row-3">
                            <div class="info-box">
                                <label>Nomor Induk Dosen Nasional</label>
                                <div class="value"><?= htmlspecialchars($personil['nidn']) ?></div>
                            </div>

                            <div class="info-box">
                                <label>Tempat, Tanggal Lahir</label>
                                <div class="value">
                                    <?= htmlspecialchars($personil['tempat_lahir']) ?>,
                                    <?= date('d F Y', strtotime($personil['tgl_lahir'])) ?>
                                </div>
                            </div>

                            <div class="info-box">
                                <label>Jenis Kelamin</label>
                                <div class="value"><?= htmlspecialchars($personil['jenis_kelamin']) ?></div>
                            </div>

                        </div>

                        <!-- ROW 3 -->
                        <div class="info-row-3">
                            <div class="info-box">
                                <label>Nomor Telephone</label>
                                <div class="value"><?= htmlspecialchars($personil['no_telp']) ?></div>

                                <label>Email</label>
                                <div class="value"><?= htmlspecialchars($personil['email']) ?></div>
                            </div>

                            <!-- LULUSAN (OPSIONAL / BISA DIHAPUS KALAU BELUM ADA TABEL) -->
                            <div class="lulusan-box">
                                <label>Lulusan yang Telah Dihasilkan</label>
                                <div class="lulusan-grid">
                                    <div class="lulusan-item">
                                        <h3>S-1</h3>
                                        <p><?= $personil['lulusan_s1'] ?? 0 ?></p>
                                    </div>
                                    <div class="lulusan-item">
                                        <h3>S-2</h3>
                                        <p><?= $personil['lulusan_s2'] ?? 0 ?></p>
                                    </div>
                                    <div class="lulusan-item">
                                        <h3>S-3</h3>
                                        <p><?= $personil['lulusan_s3'] ?? 0 ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="info-box">
                                <label>Alamat Kantor</label>
                                <div class="value"><?= htmlspecialchars($personil['alamat_kantor']) ?></div>
                            </div>
                        </div>

                        <!-- MATA KULIAH -->
                        <div class="matkul-box">
                            <label>Mata Kuliah yang diampu</label>
                            <ol class="matkul-list">
                                <?php
                                $mataKuliah = $personil['mata_kuliah'];
                                if (!empty($mataKuliah)):
                                    foreach ($mataKuliah as $i => $mk):
                                ?>
                                        <li><?= ($i + 1) . '. ' . htmlspecialchars($mk) ?></li>
                                    <?php
                                    endforeach;
                                else:
                                    ?>
                                    <li>-</li>
                                <?php endif; ?>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>