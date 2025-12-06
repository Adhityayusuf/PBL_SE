<?php
// ambil data dari model secara manual
if (!isset($visi) || !isset($misi)) {
    require_once __DIR__ . '/../Models/ProfileModel.php';
    $profileModel = new ProfileModel();

    // Ambil data visi
    $visi = $profileModel->getVisiData();

    // Ambil data misi
    $misiRaw = $profileModel->getMisiData();
}

$title = "About Page";

$customCSS = "
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom, #003865, #0d3f66, #0d3f66);
        color: white;
    }

    /* HEADER SECTION */
    .header-section {
        margin-top: 60px;
        margin-bottom: 50px;
    }

    .building-img {
        width: 350px;
    }

    .header-title {
        font-weight: 700;
        font-size: 42px;
        line-height: 1.3;
        text-align: left;
        margin-top: 40px;
    }

    /* CARD STYLE */
    .vision-mission-card {
        background: rgba(0, 40, 80, 0.4);
        padding: 35px;
        border-radius: 25px;
        box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.3);
    }

    .title-underline {
        font-size: 26px;
        font-weight: 700;
        border-bottom: 3px solid white;
        display: inline-block;
        padding-bottom: 5px;
        margin-bottom: 20px;
    }
";

require_once __DIR__ . "/layout/header.php";
include_once __DIR__ . "/layout/navbar.php";
?>

<div class="container header-section">
    <div class="row align-items-center justify-content-center">

        <!-- foto gedung yh -->
        <div class="col-lg-4 col-md-5 text-center">
            <img src="assets/polinema1.png" 
            alt="Gedung Polinema" 
            class="building-img">
        </div>

        <!-- judulnyh -->
        <div class="col-lg-6 col-md-7">
            <h1 class="header-title">
                Visi dan Misi <br>
                Lab. Software Engineering
            </h1>
        </div>

    </div>
</div>

<div class="container my-5">
    <div class="row g-4 justify-content-center">

        <!-- Visi -->
        <div class="col-lg-5 col-md-6 d-flex">
            <div class="vision-mission-card h-100">
                <div class="title-underline">Visi</div>
                <p>
                    <?= empty($visi) ? 'Data Visi belum tersedia.' : nl2br(htmlspecialchars($visi)) ?>
                </p>
            </div>
        </div>

        <!-- Misi -->
        <div class="col-lg-5 col-md-6 d-flex">
            <div class="vision-mission-card h-100">
                <div class="title-underline">Misi</div>
                <p>
                    <?= empty($misiRaw) ? 'Data Misi belum tersedia.' : nl2br(htmlspecialchars($misiRaw)) ?>
                </p>
            </div>
        </div>

    </div>
</div>

<?php
require_once __DIR__ . "/layout/footer.php";
?>
