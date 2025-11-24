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
        margin-bottom: 50px;
        text-align: center;
        color: white;
    }

    .title-section h1 {
        font-weight: 700;
        font-size: 40px;
        line-height: 1.3;
    }

    .dosen-card {
        background: #f2f2f2;
        border-radius: 25px;
        padding: 20px;
        color: #000;
        box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.3);
    }

    .dosen-img {
        width: 100%;
        border-radius: 20px;
    }

    .name {
        font-size: 26px;
        font-weight: 700;
    }

    .role {
        font-size: 17px;
        margin-bottom: 20px;
        color: #555;
    }

    .icon-list i {
        font-size: 20px;
        margin-right: 12px;
        cursor: pointer;
        color: #333;
    }

    .icon-list i:hover {
        color: #000;
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
            "foto" => "assets/dosen.png"
        ],
        [
            "nama" => "Abdul Qodir Al-Jailani",
            "role" => "Head of Laboratory",
            "nip" => "-",
            "email" => "nakama@polinema.ac.id",
            "ruang" => "Ruang dosen 6",
            "foto" => "assets/dosen.png"
        ],
        [
            "nama" => "Abdul Qodir Al-Jailani",
            "role" => "Head of Laboratory",
            "nip" => "-",
            "email" => "nakama@polinema.ac.id",
            "ruang" => "Ruang dosen 6",
            "foto" => "assets/dosen.png"
        ],
        [
            "nama" => "Abdul Qodir Al-Jailani",
            "role" => "Head of Laboratory",
            "nip" => "-",
            "email" => "nakama@polinema.ac.id",
            "ruang" => "Ruang dosen 6",
            "foto" => "assets/dosen.png"
        ],
    ];

    foreach ($dosenList as $dosen) :
    ?>

    <div class="row justify-content-center mb-4">
        <div class="col-lg-10">

            <div class="dosen-card d-flex flex-md-row flex-column align-items-center">

                <!-- FOTO -->
                <div class="col-md-4 p-3">
                    <img src="<?php echo $dosen['foto']; ?>" class="dosen-img" alt="Foto Dosen">
                </div>

                <!-- DETAIL -->
                <div class="col-md-8 p-4">

                    <div class="name"><?php echo $dosen['nama']; ?></div>
                    <div class="role"><?php echo $dosen['role']; ?></div>

                    <p><strong>NIP</strong><br><?php echo $dosen['nip']; ?></p>
                    <p><strong>Email</strong><br><?php echo $dosen['email']; ?></p>
                    <p><strong>Ruang</strong><br><?php echo $dosen['ruang']; ?></p>

                    <!-- ICON SOSMED -->
                    <div class="icon-list mt-2">
                        <i class="bi bi-linkedin"></i>
                        <i class="bi bi-github"></i>
                        <i class="bi bi-envelope"></i>
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