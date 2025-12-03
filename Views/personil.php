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
        min-height: 250px;
        margin: 0 auto;
    }

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

    .card-content {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .name {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .role {
        font-size: 17px;
        font-weight: 400;
        color: #555;
        margin-bottom: 25px;
    }

    .detail-info {
        font-size: 16px;
        line-height: 1.8;
        color: #000;
        margin-bottom: 25px;
    }

    .detail-info div {
        margin-bottom: 10px;
    }

    .icon-list {
        display: flex;
        gap: 12px;
        padding: 0;
    }

    .icon-circle {
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
        text-decoration: none;
    }

    .icon-circle:hover {
        background: #333;
    }

    .pagination {
        gap: 8px;
        margin: 0;
        display: inline-flex;
    }

    .page-link {
        border: 1px solid #fff;
        color: #6c757d;
        padding: 8px 12px;
        border-radius: 6px;
        background: #ffffff;
        transition: 0.3s;
    }

    .page-link:hover {
        background-color: #dcdcdcff;
        border-color: #ccc;
        color: #0863C7;
    }

    .page-item.active .page-link {
        background-color: #0863C7;
        color: white;
        border-color: #0863C7;
    }

    .page-item.disabled .page-link {
        background-color: #ffffff;
        border-color: #e0e0e0;
        color: #ccc;
        cursor: not-allowed;
    }
    
    @media (max-width: 1400px) {
        .dosen-card {
            max-width: 100%;
            padding: 30px;
            gap: 25px;
        }

        .dosen-img {
            width: 200px;
            height: 260px;
        }
    }

    /* Laptop 1200px ke bawah */
    @media (max-width: 1200px) {
        .dosen-card {
            flex-direction: column;
            text-align: center;
            padding: 25px;
        }

        .img-container {
            display: flex;
            justify-content: center;
        }

        .dosen-img {
            width: 180px;
            height: 230px;
        }

        .card-content {
            align-items: center;
        }

        .detail-info {
            text-align: center;
        }

        .icon-list {
            justify-content: center;
        }
    }

    /* Tablet */
    @media (max-width: 992px) {
        .dosen-card {
            padding: 25px;
        }

        .dosen-img {
            width: 150px;
            height: 190px;
        }
    }

    /* Mobile */
    @media (max-width: 768px) {
        .dosen-card {
            flex-direction: column;
            padding: 20px;
        }

        .dosen-img {
            width: 140px;
            height: 180px;
        }
    }
    
";

require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/layout/navbar.php";
?>

<div class="container title-section">
    <h1>Profile Personil Dosen <br> Laboratorium Software Engineering</h1>
</div>

<!-- SEARCH BAR -->
<div class="container mb-5" style="max-width: 500px;">
    <form method="get" class="position-relative">
        <i class="bi bi-search" 
           style="position:absolute; left:15px; top:50%; transform:translateY(-50%); color:#6c757d;">
        </i>

        <input type="text" 
               name="search" 
               class="form-control"
               placeholder="Search"
               value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>"
               style="padding-left:45px; height:45px; border-radius:10px;">
    </form>
</div>

<div class="container pb-5">

    <?php
    require_once __DIR__ . "/../Core/Database.php";
    require_once __DIR__ . "/../Models/PersonilModel.php";

    $personilModel = new PersonilModel();
    $all_personil = $personilModel->getAllPersonil();

    $search = trim($_GET['search'] ?? '');
    if ($search !== '') {
        $all_personil = array_values(array_filter($all_personil, function ($p) use ($search) {
            return stripos($p['nama'] ?? '', $search) !== false;
        }));
    }

    $search_query = $search !== '' ? '&search=' . urlencode($search) : '';

    $items_per_page = 6;
    $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

    $total_items = count($all_personil);
    $total_pages = ceil($total_items / $items_per_page);

    if ($current_page > $total_pages && $total_pages > 0) {
        $current_page = $total_pages;
    }

    $offset = ($current_page - 1) * $items_per_page;
    $dosenList = array_slice($all_personil, $offset, $items_per_page);
?>

<div class="row justify-content-center">
<?php foreach ($dosenList as $dosen): ?>
    
    <div class="col-md-6 mb-5 d-flex justify-content-center">
        <div class="dosen-card" style="width: 100%;">
            <div class="img-container">
                <img src="<?php echo $dosen['photo_url'] ?? 'assets/default.jpg'; ?>" 
                     class="dosen-img" alt="Foto Dosen">
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
                    $social = !empty($dosen['content_social']) 
                              ? json_decode($dosen['content_social'], true) 
                              : [];

                    if (!empty($social['linkedin'])): ?>
                        <a href="<?php echo $social['linkedin']; ?>" class="icon-circle" target="_blank">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    <?php endif;

                    if (!empty($social['github'])): ?>
                        <a href="<?php echo $social['github']; ?>" class="icon-circle" target="_blank">
                            <i class="bi bi-github"></i>
                        </a>
                    <?php endif; ?>

                    <a href="mailto:<?php echo $social['email'] ?? $dosen['email']; ?>" class="icon-circle">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>
</div>



<!-- Pagination -->
<div class="row">
    <div class="col-12 text-center">
        <small style="color: white;">
            Menampilkan 
            <?php echo !empty($dosenList) ? $offset + 1 : 0; ?> - 
            <?php echo min($offset + $items_per_page, $total_items); ?> 
            dari <?php echo $total_items; ?> data
        </small>

        <div class="d-flex justify-content-center mt-3">
            <nav aria-label="Page navigation">
                <ul class="pagination">

                    <!-- Previous -->
                    <li class="page-item <?php echo $current_page <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" 
                           href="<?php echo $current_page > 1 ? '?page=' . ($current_page - 1) . $search_query : '#'; ?>">
                           Previous
                        </a>
                    </li>

                    <!-- Halaman -->
                    <?php
                    $start_page = max(1, $current_page - 2);
                    $end_page = min($total_pages, $current_page + 2);

                    if ($start_page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?page=1'.$search_query.'">1</a></li>';
                        if ($start_page > 2) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                    }

                    for ($i = $start_page; $i <= $end_page; $i++) {
                        $active = $i == $current_page ? 'active' : '';
                        echo '<li class="page-item '.$active.'">
                                <a class="page-link" href="?page='.$i.$search_query.'">'.$i.'</a>
                              </li>';
                    }

                    if ($end_page < $total_pages) {
                        if ($end_page < $total_pages - 1) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                        echo '<li class="page-item"><a class="page-link" href="?page='.$total_pages.$search_query.'">'.$total_pages.'</a></li>';
                    }
                    ?>

                    <!-- Next -->
                    <li class="page-item <?php echo $current_page >= $total_pages ? 'disabled' : ''; ?>">
                        <a class="page-link" 
                           href="<?php echo $current_page < $total_pages ? '?page=' . ($current_page + 1) . $search_query : '#'; ?>">
                           Next
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>

</div>

<?php require_once __DIR__ . "/layout/footer.php"; ?>