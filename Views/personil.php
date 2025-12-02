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
        display: flex;
        align-items: center;
        padding: 40px;
        gap: 40px;
        max-width: 800px;
        height: auto;
        min-height: 280px;
        margin: 0 auto; /* Pusatkan card */
    }

    /* IMAGE STYLING */
    .img-container {
        flex-shrink: 0;
        overflow: hidden;
        border-radius: 15px;
    }
    
    .dosen-img {
        width: 250px;
        height: 320px;
        object-fit: cover;
        object-position: center;
        display: block;
    }

    /* TEXT STYLING */
    .card-content {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        flex: 1;
    }

    .name {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 8px;
        text-align: left;
    }

    .role {
        font-size: 17px;
        font-weight: 400;
        color: #555;
        margin-bottom: 25px;
        text-align: left;
    }

    .detail-info {
        font-size: 16px;
        font-weight: 400;
        font-family: poppins, sans-serif;
        line-height: 1.8;
        color: #000;
        margin-bottom: 25px;
        text-align: left;
    }

    .detail-info div {
        margin-bottom: 10px;
    }

    /* ICON STYLING */
    .icon-list {
        display: flex;
        gap: 12px;
        justify-content: flex-start;
        padding: 0;
    }

    .icon-list .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #555;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 18px;
        transition: 0.3s;
        cursor: pointer;
        text-decoration: none;
    }

    .icon-list .icon-circle:hover {
        background: #333;
    }

    .pagination {
        margin: 0;
        gap: 8px;
        display: inline-flex;
    }

    .pagination .page-link {
        border: 1px solid #fff;
        color: #6c757d;
        padding: 8px 12px;
        border-radius: 6px;
        min-width: 40px;
        text-align: center;
        transition: all 0.3s ease;
        background: #ffffff;
    }

    .pagination .page-link:hover {
        background-color: #dcdcdcff;
        border-color: #ccc;
        color: #0863C7;
    }

    .pagination .page-item.active .page-link {
        background-color: #0863C7;
        color: white;
        border-color: #0863C7;
        border-radius: 6px;
    }

    .pagination .page-item.disabled .page-link {
        background-color: #ffffff;
        border-color: #e0e0e0;
        color: #ccc;
        cursor: not-allowed;
    }

";
require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/layout/navbar.php";
?>

<div class="container title-section">
    <h1>Profile Personil Dosen <br> Laboratorium Software Engineering</h1>
</div>

<div class="container pb-5">

    <?php 
    // Load database and model (model extends Database internally)
    require_once __DIR__ . "/../Core/Database.php";
    require_once __DIR__ . "/../Models/PersonilModel.php";

    $personilModel = new PersonilModel();
    $all_personil = $personilModel->getAllPersonil();

    // Pagination: 10 items per page
    $items_per_page = 10;
    $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $total_items = count($all_personil);
    $total_pages = $total_items > 0 ? (int) ceil($total_items / $items_per_page) : 1;

    if ($current_page > $total_pages) {
        $current_page = $total_pages;
    }

    $offset = ($current_page - 1) * $items_per_page;
    $dosenList = array_slice($all_personil, $offset, $items_per_page);
    ?>

    <?php foreach ($dosenList as $dosen) : ?>

    <div class="row justify-content-center mb-5">
        <div class="col-12">

            <div class="dosen-card">
                <div class="img-container">
                    <img src="<?php echo $dosen['photo_url'] ?? 'assets/default.jpg'; ?>" class="dosen-img" alt="Foto Dosen">
                </div>

                <div class="card-content">
                    
                    <div class="name"><?php echo $dosen['nama']; ?></div>
                    <div class="role"><?php echo $dosen['jabatan']; ?></div>

                    <div class="detail-info">
                        <div><?php echo $dosen['nip']; ?></div>
                        <div><?php echo $dosen['email'] ?? '-'; ?></div>
                        <div><?php echo $dosen['ruang_dosen'] ?? '-'; ?></div>
                    </div>

                    <div class="icon-list">
                        <?php 
                        $sosial = !empty($dosen['content_social']) ? json_decode($dosen['content_social'], true) : [];
                        if (!empty($sosial['linkedin'])): ?>
                        <a href="<?php echo $sosial['linkedin']; ?>" class="icon-circle" target="_blank"><i class="bi bi-linkedin"></i></a>
                        <?php endif; 
                        if (!empty($sosial['github'])): ?>
                        <a href="<?php echo $sosial['github']; ?>" class="icon-circle" target="_blank"><i class="bi bi-github"></i></a>
                        <?php endif; 
                        if (!empty($sosial['email'])): ?>
                        <a href="mailto:<?php echo $sosial['email']; ?>" class="icon-circle"><i class="bi bi-envelope-fill"></i></a>
                        <?php else: ?>
                        <a href="mailto:<?php echo $dosen['email']; ?>" class="icon-circle"><i class="bi bi-envelope-fill"></i></a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <?php endforeach; ?>

    <!-- Pagination controls -->
    <div class="row">
        <div class="col-12">
            <div class="text-center mt-3 mb-2">
                <small style="color: white;">
                    Menampilkan <?php echo !empty($dosenList) ? $offset + 1 : 0; ?> - <?php echo min($offset + $items_per_page, $total_items); ?> dari <?php echo $total_items; ?> data
                </small>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php
                        // Previous
                        if ($current_page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
                        } else {
                            echo '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
                        }

                        $start_page = max(1, $current_page - 2);
                        $end_page = min($total_pages, $current_page + 2);

                        if ($start_page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                            if ($start_page > 2) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                        }

                        for ($i = $start_page; $i <= $end_page; $i++) {
                            if ($i == $current_page) {
                                echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                            }
                        }

                        if ($end_page < $total_pages) {
                            if ($end_page < $total_pages - 1) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                            echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                        }

                        // Next
                        if ($current_page < $total_pages) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
                        } else {
                            echo '<li class="page-item disabled"><span class="page-link">Next</span></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>

<?php
require_once __DIR__ . "/layout/footer.php";
?>