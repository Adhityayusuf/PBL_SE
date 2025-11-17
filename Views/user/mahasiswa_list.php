<?php
require_once __DIR__ . '/../../Models/MahasiswaModel.php';


$UserModel = new ModelMahasiswa();
$mahasiswas = $UserModel->getAllMahasiswa();
?>


<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="mb-4 text-center">Daftar Mahasiswa</h4>

            <?php if (!empty($mahasiswas) && count($mahasiswas) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 60px;">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Program Studi</th>
                                <th scope="col">Angkatan</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($mahasiswas as $mhs): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($mhs['nama']) ?></td>
                                    <td><?= htmlspecialchars($mhs['nim']) ?></td>
                                    <td><?= htmlspecialchars($mhs['prodi']) ?></td>
                                    <td><?= htmlspecialchars($mhs['angkatan']) ?></td>
                                    <td>
                                        <?php if ($mhs['status'] === 'setuju'): ?>
                                            <span class="badge bg-success">Setuju</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center mb-0">
                    Belum ada data mahasiswa.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

