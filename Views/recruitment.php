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

    .desc {
        max-width: 450px;
    }

    /* FORM WRAPPER */
    .form-card {
        background: #CDE0EC;
        border-radius: 12px;
        width: 550px;
        height: 500px;
        padding: 30px;
        position: relative;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        color: #000 !important;
    }

    /* Maskot harus di dalam kotak */
    .form-card img {
        width: 100px;
        position: absolute;
        //top: -25px;
        right: 15px;
        // padding: 10px 10px;
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

    .table-wrapper {
        background: #CDE0EC;
        padding: 25px;
        border-radius: 12px;
    }

    thead {
        background: #0b4d80;
        color: white;
    }

    .badge-disetujui { background:#d3f7db;color:#1a7d32;padding:5px 12px;border-radius:6px; }
    .badge-ditolak { background:#ffd6d6;color:#b10000;padding:5px 12px;border-radius:6px; }
    .badge-menunggu { background:#fff4c4;color:#a17800;padding:5px 12px;border-radius:6px; }
";

require_once __DIR__ . "/layout/header.php";
?>

<div class="container-fluid header-section">
    <div class="row align-items-start">

        <!-- LEFT TEXT -->
        <div class="col-md-6">
            <h1 class="fw-bold mb-3 text-center">
                Software Engineering <br> Geeks Recruitment
            </h1>

            <p class="desc mx-auto text-center">
                Bergabunglah dengan Software Engineering Geeks untuk mengasah skillmu dalam desain arsitektur,
                pengembangan web & mobile, pengujian perangkat lunak, hingga praktik DevOps modern. Kami adalah
                wadah bagi talenta yang bersemangat menciptakan solusi teknologi revolusioner.
            </p>
        </div>

        <!-- FORM -->
        <div class="col-md-4 offset-md-1">
            <div class="form-card">
                <img src="assets/sip.png" alt="Mascot">

                <h4 class="fw-bold mb-3">Ayo jadi bagian<br>dari Kami</h4>

                <form>
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control mb-2" placeholder="Nama Lengkap">

                    <label class="form-label">NIM</label>
                    <input type="text" class="form-control mb-2" placeholder="Nomor Induk Mahasiswa">

                    <div class="row">
                        <div class="col">
                            <label class="form-label">Program Studi</label>
                            <select class="form-control mb-2">
                                <option>Informatika</option>
                                <option>Sistem Informasi</option>
                                <option>Manajemen Informatika</option>
                                <option>DKV</option>
                                <option>Teknik Komputer</option>
                            </select>
                        </div>

                        <div class="col">
                            <label class="form-label">Tahun</label>
                            <input type="number" class="form-control mb-2" placeholder="2025">
                        </div>
                    </div>

                    <label class="form-label">Minat</label>
                    <select class="form-control mb-4">
                        <option>Web</option>
                        <option>Mobile</option>
                        <option>QA</option>
                        <option>DevOps</option>
                    </select>

                    <button class="btn btn-daftar">Daftar</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Divider -->
<div class="divider"></div>

<!-- TABLE SECTION (SAMA SEPERTI SEBELUMNYA) -->

<div class="container py-4 mb-5">
    <h3 class="text-center text-white mb-4 fw-bold">Daftar Mahasiswa SE Geeks</h3>

    <div class="table-wrapper mx-auto">
        <table id="tabelMahasiswa" class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <th>Tahun</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Lorem Ipsum</td><td>12345678</td><td>Informatika</td><td>2025</td><td><span class='badge-disetujui'>Disetujui</span></td></tr>
                <tr><td>Lorem Ipsum</td><td>12345678</td><td>Informatika</td><td>2025</td><td><span class='badge-ditolak'>Ditolak</span></td></tr>
                <tr><td>Lorem Ipsum</td><td>12345678</td><td>Informatika</td><td>2025</td><td><span class='badge-menunggu'>Menunggu</span></td></tr>
                <tr><td>Lorem Ipsum</td><td>12345678</td><td>Informatika</td><td>2025</td><td><span class='badge-disetujui'>Disetujui</span></td></tr>
                <tr><td>Lorem Ipsum</td><td>12345678</td><td>Informatika</td><td>2025</td><td><span class='badge-menunggu'>Menunggu</span></td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $("#tabelMahasiswa").DataTable({
        searching: true,
        ordering: true,
        pageLength: 5
    });
});
</script>

<?php
require_once __DIR__ . "/layout/footer.php";
?>

