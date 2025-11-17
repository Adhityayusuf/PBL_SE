<?php 
$title = "Blog Terbaru";

require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/layout/navbar.php";
require_once __DIR__ . "/../Core/Database.php";
require_once __DIR__ . "/../Models/BlogModel.php";

$blogModel = new BlogModel();
$blogs = $blogModel->getAllBlogs();

?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Blog Terbaru</h2>
    <div class="row">
        <?php foreach ($blogs as $blog): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="<?= htmlspecialchars($blog['title']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($blog['title']); ?></h5>
                        <p class="card-text"><?= substr(htmlspecialchars($blog['content']), 0, 120) . '...'; ?></p>
                        <p class="text-muted mb-1"><small>By <?= htmlspecialchars($blog['author']); ?></small></p>
                        <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>