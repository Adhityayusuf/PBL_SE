<?php
$title = "Profile Personil Dosen";

$customCSS = "
    body {
        background: #082a4c;
        font-family: 'Poppins', sans-serif;
        color: white;
    }

    .title-section {
        margin-top: 120px;
        margin-bottom: 120px;
        text-align: center;
        color: white;
    }

    .title-section h1 {
        font-weight: 700;
        font-size: 40px;
        line-height: 1.3;
    }

    /* CARD STYLING */
    .dosen-card {
        background: #e6e7e9;
        border-radius: 20px;
        color: #000;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        border: none;
    }

    /* IMAGE STYLING */
    .img-container {
        height: 100%;
        min-height: 300px;
    }
    
    .dosen-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
    }

    /* TEXT STYLING */
    .card-content {
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }

    .name {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
        text-align: center;
    }

    .role {
        font-size: 18px;
        font-weight: 300;
        color: #444;
        margin-bottom: 30px;
        text-align: center;
    }

    .detail-info {
        font-size: 16px;
        font-weight: 500;
        font-family: poppins, sans-serif;
        line-height: 1.8;
        color: #000;
        margin-bottom: 20px;
        text-align: left;
    }

    /* ICON STYLING */
    .icon-list {
        display: flex;
        gap: 10px;
        justify-content: flex-start;
        padding: 0;
    }

    .icon-list .icon-circle {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: #555;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 16px;
        transition: 0.3s;
        cursor: pointer;
        text-decoration: none;
    }

    .icon-list .icon-circle:hover {
        background: #333;
    }
";

require_once __DIR__ . "/layout/header.php";
?>

<div class="container title-section">
    <h1>Profile Personil Dosen <br> Laboratorium Software Engineering</h1>
</div>

<div class="container pb-5">

    <?php 
    // contoh data dosen (bisa diganti dengan database nanti)
    $dosenList = [
        [
            "nama" => "Abdul Qodir Al-Jailani",
            "role" => "Head of Laboratory",
            "nip" => "-",
            "email" => "nakama@polinema.ac.id",
            "ruang" => "Ruang dosen 6",
            "foto" => "assets/tes1.png"
        ],
        [
            "nama" => "Abdul Qodir Al-Jailani",
            "role" => "Head of Laboratory",
            "nip" => "-",
            "email" => "nakama@polinema.ac.id",
            "ruang" => "Ruang dosen 6",
            "foto" => "assets/tes1.png"
        ],
        [
            "nama" => "Abdul Qodir Al-Jailani",
            "role" => "Head of Laboratory",
            "nip" => "-",
            "email" => "nakama@polinema.ac.id",
            "ruang" => "Ruang dosen 6",
            "foto" => "assets/tes1.png"
        ],
        [
            "nama" => "Abdul Qodir Al-Jailani",
            "role" => "Head of Laboratory",
            "nip" => "-",
            "email" => "nakama@polinema.ac.id",
            "ruang" => "Ruang dosen 6",
            "foto" => "assets/tes1.png"
        ],
    ];?>

    <?php foreach ($dosenList as $dosen) : ?>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">

            <div class="dosen-card">
                <div class="row g-0"> <div class="col-md-5"> 
                        <div class="img-container">
                            <img src="<?php echo $dosen['foto']; ?>" class="dosen-img" alt="Foto Dosen">
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="card-content">
                            
                            <div class="name"><?php echo $dosen['nama']; ?></div>
                            <div class="role"><?php echo $dosen['role']; ?></div>

                            <div class="detail-info">
                                <div><?php echo $dosen['nip'] == '-' ? 'NIP' : $dosen['nip']; ?></div>
                                <div><?php echo $dosen['email']; ?></div>
                                <div><?php echo $dosen['ruang']; ?></div>
                            </div>

                            <div class="icon-list">
                                <a href="#" class="icon-circle"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="icon-circle"><i class="bi bi-github"></i></a>
                                <a href="#" class="icon-circle"><i class="bi bi-envelope-fill"></i></a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <?php endforeach; ?>

</div>

<?php
require_once __DIR__ . "/layout/footer.php";
?>