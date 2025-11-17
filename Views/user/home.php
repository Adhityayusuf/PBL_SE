<?php
$title = "Daftar Mahasiswa";


require_once __DIR__ . "/../../Core/Database.php";
require_once __DIR__ . "/../../Models/MahasiswaModel.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $angkatan = $_POST['angkatan'];

    
    $UserModel = new ModelMahasiswa();
    if($UserModel->getMahasiswaByNim($nim)){
        $message = "<div class='alert alert-warning'>NIM sudah terdaftar.</div>";
    }else{
        $isAdded = $UserModel->addMahasiswa($nama, $nim, $prodi, $angkatan);
        
        if($isAdded){
            $message = "<div class='alert alert-success'>Data mahasiswa berhasil ditambahkan!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Gagal menambahkan data mahasiswa.</div>";
        }
    }
}
require_once __DIR__ . "/../layout/header.php";
require_once __DIR__ . "/../layout/navbar.php";
?>

<div class="container" style="max-width: 500px; margin-top: 60px;">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="text-center mb-4">Form Data Mahasiswa</h4>

            <?= $message ?? '' ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required>
                </div>

                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <select class="form-select" id="prodi" name="prodi" required>
                        <option value="" selected disabled>Pilih Program Studi</option>
                        <option value="TI">Teknologi Informasi</option>
                        <option value="SIB">Sistem Informasi Bisnis</option>
                        <option value="PPLS">Pengembangan Perangkat Lunak dan Sistem</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <input type="number" class="form-control" id="angkatan" name="angkatan" placeholder="Contoh: 2022" min="2000" max="<?= date('Y') + 1 ?>" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">
                    Simpan Data
                </button>
            </form>
        </div>
    </div>
</div>

           

<?php 
require_once __DIR__ . "/mahasiswa_list.php";
require_once __DIR__ . "/../layout/footer.php"; ?>
