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
        }

        /* ===== LAYOUT ===== */
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            padding: 35px;
            margin: 0px 0px 20px 65px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 1092px;
            max-width: 100%;
        }

        /* ===== HEADER ===== */
        .card h1 {
            font-size: 28px;
            margin-bottom: 50px;
            color: #333;
            font-weight: 700;
        }

        /* ===== TIMELINE CONTAINER ===== */
        .timeline {
            position: relative;
            padding: 20px 0;
        }

        /* ===== TIMELINE LINE (Desktop) ===== */
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #e0e0e0; 
            transform: translateX(-50%);
            border-radius: 2px;
            z-index: 1;
        }

        /* ===== TIMELINE ITEM (Desktop: Flexbox untuk Zigzag) ===== */
        .timeline-item {
            position: relative;
            margin-bottom: 60px;
            display: flex; /* Aktifkan Flexbox */
            align-items: center;
            width: 100%;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        /* ===== TIMELINE DOT ===== */
        .timeline-dot {
            position: absolute;
            left: 50%;
            width: 20px; 
            height: 20px;
            background: #FEC01D;
            border-radius: 50%;
            transform: translateX(-50%);
            z-index: 2;
            box-shadow: 0 0 0 4px #fff;
            transition: all 0.3s ease;
        }

        .timeline-item:hover .timeline-dot {
            transform: translateX(-50%) scale(1.2);
            background: #ffaa00;
            box-shadow: 0 0 0 6px #fff;
        }

        /* ===== TIMELINE CONTENT ===== */
        .timeline-content {
            width: 45%;
            min-height: 220px;           
            display: flex;               
            flex-direction: column;      
            justify-content: space-between; 
            
            background: #02294A;
            border-radius: 15px;
            padding: 30px;
            color: #fff;
            position: relative;
            box-shadow: 0 5px 15px rgba(2, 41, 74, 0.5);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }


        .timeline-content:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(2, 41, 74, 0.4);
            background: #033660;
        }

        /* ===== LEFT & RIGHT POSITIONING (Desktop: Menggunakan Flexbox) ===== */
        .timeline-item.left {
            justify-content: flex-start;
        }
        
        .timeline-item.right {
            justify-content: flex-end;
        }
        
        /* Tambahan: Rata Kanan untuk konten sebelah kiri */
        .timeline-item.left .timeline-content {
            text-align: right;
        }

        /* ===== TYPOGRAPHY ===== */
        .timeline-content h3 {
            font-size: 18px;
            color: #FEC01D;
            margin-bottom: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .timeline-content .program {
            font-size: 14px;
            margin-bottom: 10px;
            color: #e0e0e0;
            font-weight: 600;
            display: inline-block;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding-bottom: 5px;
        }

        .timeline-content .thesis {
            font-size: 14px;
            line-height: 1.6;
            color: #ccc;
        }

        /* ===== RESPONSIVE (Mobile) ===== */
        @media (max-width: 768px) {
            .card {
                padding: 30px 20px;
            }

            .card h1 {
                font-size: 24px;
                margin-bottom: 30px;
            }

            /* Garis dan Dot Pindah ke Kiri (20px) */
            .timeline::before, .timeline-dot {
                left: 20px;
                transform: none;
            }
            
            .timeline-dot {
                box-shadow: 0 0 0 4px #fff; /* Pastikan dot tidak bergeser */
            }

            .timeline-item {
                /* Semua item dimulai dari kiri */
                justify-content: flex-start !important;
                margin-bottom: 40px;
            }
            
            /* Konten mengambil lebar penuh dan ada di kanan garis */
            .timeline-content {
                width: calc(100% - 60px);
                margin-left: 60px !important; /* Dorong konten ke kanan dot */
                text-align: left !important;
            }
            
            /* Reset positioning classes */
            .timeline-item.left .timeline-content,
            .timeline-item.right .timeline-content {
                text-align: left !important;
            }

            .timeline-content:hover {
                transform: none;
            }
        }";
        include __DIR__ . '/layout/header.php'
?>
<div class="layout">
    <?= include __DIR__ . '/layout/sidebar.php' ?>
    <div class="main-content">
        <div class="content-wrapper">
            <div class="container">
                <div class="card">
                    <h2>Riwayat Pendidikan</h2>
                    <br>
                    <div class="timeline">
                        <?php
                        if (!empty($pendidikan) && is_array($pendidikan)) {
                            $i = 1;
                            // Hapus $index di sini karena tidak digunakan/berpotensi string
                            foreach ($pendidikan as $item): 
    
                                // PERBAIKAN: Gunakan $i (integer counter) untuk modulo
                                $position = ($i % 2 === 1) ? 'left' : 'right'; // Menggunakan 1 untuk memastikan item pertama (i=1) ada di 'left'
                        ?>
                                <div class="timeline-item <?= $position ?>">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <?php
                                            // Menggunakan operator null coalescing (??) untuk mencegah error "Undefined array key"
                                            $universitas = htmlspecialchars($item['universitas'] ?? 'Institusi Tidak Diketahui');
                                            $program_studi = htmlspecialchars($item['program_studi'] ?? 'Jurusan Tidak Ada');
                                            $tahun_lulus = htmlspecialchars($item['tahun_lulus'] ?? '?');
                                            $judul_tugas = htmlspecialchars($item['judul_tugas'] ?? '—');
                                        ?>
                                        <h3><?php echo "S". $i?> - <?= $universitas ?></h3>
                                        <div class="program">
                                            <?= $program_studi ?>
                                            (<?= $tahun_lulus ?>)
                                        </div>
                                        <p class="thesis"><?= $judul_tugas ?></p>
                                    </div>
                                </div>
                        <?php
                                $i++;
                            endforeach;
                        } else {
                            // Tampilkan pesan jika data kosong
                            echo '<p style="text-align: center; color: #666;">Data riwayat pendidikan belum tersedia.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

</body>

</html>