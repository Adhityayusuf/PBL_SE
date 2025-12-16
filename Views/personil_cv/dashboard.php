<?php
$personil = $personil ?? [];
$stats    = $stats ?? [];

$customCSS = "
        /* ===== RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        .content {
        flex: 1;
        padding: 20px 0px 20px 0px;
    }

        /* ===== BODY (MODIFIED FONT) ===== */
        body {
            font-family: 'Poppins', sans-serif;
            background: #0a2647;
            min-height: 100vh;

        }
        .main-content {
            padding: 0px 30px 30px 30px;
            width: calc(100%);
        }
        /* ===== LAYOUT ===== */
        .container {
            max-width: 1400px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* ===== PROFIL ===== */
        .profil-card {
            grid-row: span 2;
        }

        .profil-card h2 {
            font-size: 24px;
            margin-bottom: 25px;
            color: #2e2e2eff;
            font-weight: 700;
        }

        .profil-content {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }

        .foto-profil {
            width: 160px;
            height: 220px;
            background: #ddd;
            border-radius: 10px;
            flex-shrink: 0;
            object-fit: cover;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-item label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icons a {
            width: 30px;
            height: 30px;
            background: #555;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
        }

        .social-icons a:hover {
            background: #333;
        }

        .mengajar-section h3 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
            font-weight: 600;
        }

        .mata-kuliah-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* ===== MATA KULIAH ITEM (MODIFIED SHADOW) ===== */
        .mata-kuliah-item {
            background: #fec01d;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            color: #030303ff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        /* Efek Hover Mata Kuliah */
        .mata-kuliah-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* ===== DESKRIPSI ===== */
        .deskripsi-card {
            display: flex;
            align-items: center;
        }

        .deskripsi-card p {
            font-size: 14px;
            line-height: 1.8;
            color: #2e2e2eff;
        }

        /* ===== PENDIDIKAN ===== */
        .pendidikan-card {
            padding: 30px 50px;
        }

        .pendidikan-card h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 25px;
            color: #2e2e2eff;
            font-weight: 700;
        }

        .pendidikan-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px;
            max-width: 850px;
            margin: 0 auto;
            text-align: center;
        }

        .pendidikan-item h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #2e2e2eff;
            font-weight: 600;
        }

        .pendidikan-item p {
            font-size: 14px;
            color: #2e2e2eff;
            line-height: 1.5;
        }

        /* ===== STATISTIK ===== */
        .pencapaian-card h2,
        .pengalaman-card h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
            font-weight: 700;
        }

        .pencapaian-card p,
        .pengalaman-card p {
            font-size: 13px;
            color: #2e2e2eff;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-item {
            background: #f9f9f9;
            border-radius: 15px;
            padding: 10px 8px;
            text-align: center;
            border: 2px solid #f0f0f0;
            transition: 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }

        .stat-item:hover {
            border-color: #0b4f7a;
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .stat-label {
            font-size: 13px;
            color: #2e2e2eff;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: #2e2e2eff;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .stat-icon {
            color: #0b4f7a;
            font-size: 18px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .container {
                grid-template-columns: 1fr;
            }

            .profil-card {
                grid-row: auto;
            }
        }

        @media (max-width: 768px) {
            .profil-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .pendidikan-grid,
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .social-icons {
                justify-content: center;
            }
    }";

include __DIR__ . '/layout/header.php';

?>


<div class="layout">
<?php
include __DIR__ . '/layout/sidebar.php'
?>
    <div class="main-content">
        <div class="content-wrapper">
            <div class="container">
                <div class="card profil-card">
                    <h2>Profil Singkat</h2>
                    <div class="profil-content">
                        <img src="<?= $personil['photo_url'] ?? '/assets/default.jpg' ?>" class="foto-profil">
                        <div class="profil-info">
                            <div class="info-item"><label><?= $personil['nama'] ?? '-' ?></label></div>
                            <div class="info-item"><label><?= $personil['jabatan'] ?? '-' ?></label></div>
                            <div class="info-item"><label><?= $personil['nip'] ?? '-' ?></label></div>
                            <div class="info-item"><label><?= $personil['email'] ?? '-' ?></label></div>
                            <div class="info-item"><label><?= $personil['ruang_dosen'] ?? '-' ?></label></div>
                            <div class="social-icons">
                                <a href="<?= htmlspecialchars($personil['linkedin'] ?? '#') ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                                <a href="<?= htmlspecialchars($personil['github'] ?? '#') ?>" target="_blank"><i class="fab fa-github"></i></a>
                                <a href="<?= htmlspecialchars($personil['email'] ?? '#') ?>" target="_blank"><i class="fas fa-envelope"></i></a>
                            </div>
                            <!-- Mengajar tepat di bawah info -->
    
                        </div>
                    </div>
                    <div class="mengajar-section">
                        <h3>Mengajar:</h3>
                        <div class="mata-kuliah-list">
                            <?php foreach ($personil['mata_kuliah'] ?? [] as $mk): ?>
                                <div class="mata-kuliah-item"><?= htmlspecialchars($mk) ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
    
                <!-- Deskripsi Diri -->
                <div class="card deskripsi-card">
                    <p><?= nl2br($personil['desc_diri'] ?? '-') ?></p>
                </div>
    
                <!-- Pendidikan -->
                <div class="card pendidikan-card">
                    <h2>Pendidikan</h2>
                    <div class="pendidikan-grid">
                        <?php foreach (['sarjana' => 'S-1', 'magister' => 'S-2', 'doktor' => 'S-3'] as $key => $label): ?>
                            <div class="pendidikan-item">
                                <h3><?= $label ?></h3>
                                <p><?= $pendidikan[$key]['universitas'] ?? '-' ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
    
                <!-- Pencapaian -->
                <div class="card pencapaian-card">
                    <h2>Pencapaian</h2>
                    <p>Publikasi, karya buku, dan HKI dalam 5 tahun terakhir</p>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-label">Publikasi</div>
                            <div class="stat-value"><?= $stats['publikasi'] ?? 0 ?> <i class="fas fa-external-link-alt stat-icon"></i></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Buku</div>
                            <div class="stat-value"><?= $stats['karya_buku'] ?? 0 ?> <i class="fas fa-external-link-alt stat-icon"></i></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">HKI</div>
                            <div class="stat-value"><?= $stats['hki'] ?? 0 ?> <i class="fas fa-external-link-alt stat-icon"></i></div>
                        </div>
                    </div>
                </div>
    
                <!-- Pengalaman -->
                <div class="card pengalaman-card">
                    <h2>Pengalaman</h2>
                    <p>Penelitian dan pengabdian masyarakat 5 tahun terakhir</p>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-label">Penelitian</div>
                            <div class="stat-value"><?= $stats['penelitian'] ?? 0 ?> <i class="fas fa-external-link-alt stat-icon"></i></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Pengabdian</div>
                            <div class="stat-value"><?= $stats['pengabdian'] ?? 0 ?> <i class="fas fa-external-link-alt stat-icon"></i></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>

</html>