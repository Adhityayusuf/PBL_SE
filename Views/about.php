<?php
$title = "About Page";

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../Models/aboutModel.php";
require_once __DIR__ . "/./header.php";
require_once __DIR__ . "/./navbar.php";

$Model = new aboutModel();

$visi = $Model->getVisi();
$misi = $Model->getMisi();
$tentang = $Model->getTentang();

?>
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold">Tentang Laboratorium Sistem & Rekayasa Perangkat Lunak</h2>

    <div class="row g-4">
        <!-- Tentang -->
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-4 p-4 bubble-card">
                <h4 class="fw-semibold mb-3">Tentang Lab</h4>
                <p class="text-muted mb-0">
                    <?= htmlspecialchars($tentang) ?>
                </p>
            </div>
        </div>

        <!-- Visi -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4 bubble-card">
                <h4 class="fw-semibold mb-3">Visi</h4>
                <p class="text-muted mb-0">
                    <?= htmlspecialchars($visi) ?>
                </p>
            </div>
        </div>

        <!-- Misi -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4 bubble-card">
                <h4 class="fw-semibold mb-3">Misi</h4>
                <ul class="text-muted mb-0">
                   <?php if(is_array($misi)): ?>
                        <?php foreach ($misi as $item): ?>
                            <li><?= htmlspecialchars($item) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><?= htmlspecialchars($misi) ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

