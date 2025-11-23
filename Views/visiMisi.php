<?php
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
        <div class="col-lg-5 col-md-6">
            <div class="vision-mission-card">
                <div class="title-underline">Visi</div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat.
                </p>
            </div>
        </div>

        <!-- Misi -->
        <div class="col-lg-5 col-md-6">
            <div class="vision-mission-card">
                <div class="title-underline">Misi</div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat.
                </p>
            </div>
        </div>

    </div>
</div>

<?php
require_once __DIR__ . "/layout/footer.php";
?>
