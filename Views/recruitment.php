<?php 
$title = "Recruitment Page";

$customCSS = "
    body {
        background: #003a6b;
        font-family: 'Poppins', sans-serif;
    }

    /* HEADER */
    .header-section {
        padding: 60px 40px;
        color: white;
    }

    .ft-custom {
        font-size: 40px;
        padding-left: 60px;
    }

    .desc {
        max-width: 650px;
        text-align: justify;
        font-size: 22px;
        padding-left: 60px;
    }

    /* FORM WRAPPER */
    .form-card {
        background: #CDE0EC;
        border-radius: 12px;
        width: 610px;
        height: 580px;
        padding: 30px;
        position: relative;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        color: #000 !important;
    }

    /* Maskot harus di dalam kotak */
    .form-card img {
        width: 130px;
        position: absolute;
        top: 30px;
        right: 30px;
        transform: translateX(-15px);
    }

    /* Tombol daftar warna kuning */
    .btn-daftar {
        background: #ffcc00;
        color: black;
        border-radius: 8px;
        padding: 10px 22px;
        font-weight: bold;
        float: right;
    }

    .btn-daftar:hover {
        background: #e6b800;
        color: black;
    }

    /* Divider */
    .divider {
        width: 70%;
        margin: 40px auto;
        border-bottom: 2px solid #789abd;
    }

    /* STYLE KUSTOM TABEL YANG DIMINTA USER */
    .table-wrapper {
        background: #CDE0EC; /* Background Card */
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2); /* Tambahan shadow agar mirip form-card */
    }

    .table-wrapper thead {
        background: #0b4d80; /* Header Biru Tua */
        color: white;
    }
    
    /* Override warna header DataTables agar konsisten dengan style thead kustom */
    .table-wrapper thead th {
        background: #0b4d80 !important;
        color: white !important;
    }
    
    /* Badge Kustom Dibuat Ulang (walau lebih baik pakai bg-* Bootstrap) */
    .badge-disetujui { background:#d3f7db;color:#1a7d32;padding:5px 12px;border-radius:6px; }
    .badge-ditolak { background:#ffd6d6;color:#b10000;padding:5px 12px;border-radius:6px; }
    .badge-menunggu { background:#fff4c4;color:#a17800;padding:5px 12px;border-radius:6px; }

    .ps-6 { padding-left: 6rem !important;}
    
    /* FIX FOR DATATABLES BORDER in custom wrapper*/
    .table-wrapper .dataTables_wrapper .row {
        margin-left: 0;
        margin-right: 0;
    }
";

require_once __DIR__ . "/layout/header.php";
include_once __DIR__ . "/layout/navbar.php";
?>

<div class="container-fluid header-section">
    <div class="row align-items-start">

        <div class="col-md-6 pt-5 ps-5">
            <h1 class="fw-bold mb-3 text-center ft-custom">
                Software Engineering <br> Geeks Recruitment
            </h1>

            <p class="desc mx-auto">
                <br>Bergabunglah dengan Software Engineering Geeks untuk mengasah skillmu dalam desain arsitektur,
                pengembangan web & mobile, pengujian perangkat lunak, hingga praktik DevOps modern. Kami adalah
                wadah bagi talenta yang bersemangat menciptakan solusi teknologi revolusioner.
            </p>
        
        </div>

        <div class="col-md-4 ps-4">
            <div class="form-card">
                <img src="assets/sip.png" alt="Mascot">

                <h4 class="fw-bold mb-3 ps-3 pt-3 fs-2">Jadilah Bagian dari<br>Inovasi Teknologi!</h4>

                <form action="index.php?action=recruitmentAdd" method="POST">
                    <br>
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Lengkap">

                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control mb-2" placeholder="Nomor Induk Mahasiswa">

                    <div class="row">
                        <div class="col">
                            <label class="form-label">Program Studi</label>
                            <select name="prodi" class="form-control mb-2">
                                <option value="1">Informatika</option>
                                <option value="2">Sistem Informasi</option>
                                <option value="3">Manajemen Informatika</option>
                            </select>
                        </div>

                        <div class="col">
                            <label class="form-label">Angkatan</label>
                            <input type="number" name="angkatan" class="form-control mb-2" placeholder="2025">
                        </div>
                    </div>

                    <label class="form-label">Minat</label>
                    <select name="minat" class="form-control mb-4">
                        <option>Web</option>
                        <option>Mobile</option>
                        <option>QA</option>
                        <option>DevOps</option>
                    </select>

                    <button class="btn btn-daftar icon-bold" name="submit"><i class="bi bi-mortarboard"></i>  Daftar</button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="divider"></div>

<div class="container py-4 mb-5">
    
    <div class="table-wrapper mx-auto" style="max-width: 900px;">
        <h3 class="text-center text-black mb-4 fw-bold">Daftar Mahasiswa SE Geeks</h3>
        
        <table id="tabelMahasiswa" class="table table-striped table-hover align-middle">
            <thead>
                <tr> <th>Nama</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <th>Angkatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (!empty($recruitmentList)) {
                    foreach($recruitmentList as $mhs){ 
                ?>
                        <tr>
                            <td><?= htmlspecialchars($mhs['nama']); ?></td>
                            <td><?= htmlspecialchars($mhs['nim']); ?></td>
                            <td><?= htmlspecialchars($mhs['prodi']); ?></td>
                            <td><?= htmlspecialchars($mhs['angkatan']); ?></td>
                            <td>
                                <?php if($mhs['status'] == 'menunggu'){ ?>
                                    <span class="badge badge-menunggu">Menunggu</span>
                                <?php } elseif($mhs['status'] == 'setuju'){ ?>
                                    <span class="badge badge-disetujui">Disetujui</span>
                                <?php } else{ ?>
                                    <span class="badge badge-ditolak">Ditolak</span>
                                <?php } ?>
                            </td>
                        </tr>
                <?php 
                    } 
                } else {
                    // Pastikan ada pesan jika data kosong
                    echo '<tr><td colspan="5" class="text-center">Tidak ada data mahasiswa.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function () {
    $("#tabelMahasiswa").DataTable({
        searching: true,
        ordering: true,
        pageLength: 10,
        lengthMenu: [10, 20, 30, 50],
        
        // DOM configuration untuk layout Bootstrap
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        
        language: {
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            search: "Cari:",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Data tidak tersedia",
            paginate: {
                previous: "Sebelumnya",
                next: "Selanjutnya"
            }
        }
    });
});
</script>

<?php
require_once __DIR__ . "/layout/footer.php";
?>