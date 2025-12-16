<?php
    $role = $_SESSION['role'] ?? 'dosen'; // default dosen
    $username = $_SESSION['username'] ?? 'User';
    $email = $_SESSION['email'] ?? 'user@example.com';
    $initial  = strtoupper(substr($username, 0, 1));
    $photo    = $_SESSION['photo_url'] ?? 'default.jpg';
?>

<style>
    .sidebar-custom {
        width: 280px;
        min-height: 100vh;
        background: #ffffff; 
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        padding: 30px 20px;
        border-top-right-radius: 30px;
        border-bottom-right-radius: 30px;
        font-family: 'Poppins', sans-serif;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: #333333;
        font-weight: 500;
        font-size: 1rem;
        text-decoration: none;
        margin-bottom: 8px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .sidebar-link i {
        font-size: 1.35rem;
        width: 35px;
        display: inline-flex;
        justify-content: flex-start;
        align-items: center;
        margin-right: 10px;
        color: #333333;
    }

    .sidebar-link:hover {
        background-color: #06315A; 
        color: white;
        opacity: 0.9;
    }
    .sidebar-link:hover i {
        color: white;
    }

    .sidebar-link.active,
    .sidebar-link.active:hover {
        background-color: #06315A; 
        color: white;
        font-weight: 600; 
        opacity: 1;
    }

    .sidebar-link.active i {
        color: white !important; /* Pastikan ikon juga putih saat aktif */
    }

    .support-heading {
        font-size: 0.95rem;
        font-weight: 600;
        color: #888;
        margin-top: 25px;
        margin-bottom: 10px;
        padding-left: 15px;
        display: block;
    }

    .user-footer {
        margin-top: auto;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    
    .user-info .fw-bold {
        font-size: 0.95rem;
        color: #333;
    }
    .user-info .text-muted {
        font-size: 0.8rem;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<div class="sidebar-custom d-flex flex-column flex-shrink-0">
    
    <div class="mb-5 px-2">
        <img src="/Views/assets/LAB.png" alt="Logo Lab" class="img-fluid" style="max-height: 60px;">
    </div>

    <ul class="nav flex-column mb-auto">
        
        <li class="nav-item">
            <?php if ($role === 'admin') : ?>
                <a href="/admin/index.php?action=profil" class="sidebar-link">  
                    <i class="bi bi-grid"></i> Profil Lab
                </a>
            <?php else :?>
                <a href="/admin/index.php?action=dashboard_personil" class="sidebar-link">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            <?php endif; ?>
        </li>

        <li class="nav-item">
            <?php if ($role === 'admin'): ?>
                <a href="/admin/index.php?action=segeeks" class="sidebar-link">
                    <i class="bi bi-lightning-charge-fill"></i> Pengelolaan SE Geeks
                </a>
            <?php else : ?>
                <a href="/admin/index.php?action=identitas" class="sidebar-link">
                    <i class="bi bi-person-vcard"></i> Identitas Diri
                </a>
            <?php endif; ?>
        </li>

        <li class="nav-item">
            <?php if ($role === 'admin'): ?>
                <a href="/admin/index.php?action=personil" class="sidebar-link">
                    <i class="bi bi-people-fill"></i> Personil
                </a>
            <?php else: ?>
                <a href="/admin/index.php?action=riwayat" class="sidebar-link">
                    <i class="bi bi-mortarboard"></i> Riwayat Pendidikan
                </a>
            <?php endif; ?>
        </li>

        <li class="nav-item">
            <?php if ($role === 'admin') : ?>
                <a href="/admin/index.php?action=blog" class="sidebar-link">
                    <i class="bi bi-check-square-fill fs-5"></i> Blog Artikel
                </a>
            <?php else :?>
                <a href="/admin/index.php?action=penelitian" class="sidebar-link">
                    <i class="bi bi-search fs-5"></i> Penelitian
                </a>
            <?php endif; ?>
        </li>
        
        <li class="nav-item">
            <?php if (!($role === 'admin')) : ?>
                <a href="/admin/index.php?action=pengabdian" class="sidebar-link">
                    <i class="bi bi-people fs-5"></i> Pengabdian
                </a>
            <?php endif; ?>
        </li>
        
        <li class="nav-item">
            <?php if (!($role === 'admin')) : ?>
                <a href="/admin/index.php?action=artikel_ilmiah" class="sidebar-link">
                    <i class="bi bi-newspaper fs-5"></i> Artikel Ilmiah
                </a>
            <?php endif; ?>
        </li>
        
        <li class="nav-item">
            <?php if (!($role === 'admin')) : ?>
                <a href="/admin/index.php?action=karya_buku" class="sidebar-link">
                    <i class="bi bi-book-half fs-5"></i> Karya Buku
                </a>
            <?php endif; ?>
        </li>
        
        <li class="nav-item">
            <?php if (!($role === 'admin')) : ?>
                <a href="/admin/index.php?action=hki" class="sidebar-link">
                    <i class="bi bi-patch-check fs-5"></i> Perolehan HKI
                </a>
            <?php endif; ?>
        </li>

        <?php if ($role === 'dosen') : ?>
        <li class="nav-item">
            <span class="support-heading">Blog</span>
        </li>

        <li class="nav-item">
            <a href="/admin/index.php?action=blog" class="sidebar-link">
                <i class="bi bi-check-square-fill"></i> Blog Saya
            </a>
        </li>
        <?php endif; ?>

        <li class="nav-item">
            <span class="support-heading">Support</span>
        </li>

        <li class="nav-item">
            <a href="/admin/index.php?action=settings" class="sidebar-link">
                <i class="bi bi-gear-fill"></i> Settings
            </a>
        </li>

    </ul>
    <div class="user-footer">
        <div class="d-flex align-items-center">
            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold me-3" 
                style="width: 45px; height: 45px; font-size: 1.2rem;">
                <img src="/Views/assets/<?= htmlspecialchars($_SESSION['photo_url'] ?? 'default.jpg'); ?>" alt="<?= htmlspecialchars($username); ?>" onerror="showInitialAvatar(this, '<?= htmlspecialchars($initial); ?>');" class="rounded-circle" style="width:100%; height:100%;">
            </div>
            
            <div class="user-info">
                <div class="fw-bold"><?= htmlspecialchars($username); ?></div>
                <div class="text-muted"><?= htmlspecialchars($email); ?></div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const sidebarLinks = document.querySelectorAll('.sidebar-link');

    sidebarLinks.forEach(link => {
        link.addEventListener('click', function () {
            // Remove 'active' class from all links
            sidebarLinks.forEach(link => link.classList.remove('active'));
            
            // Add 'active' class to the clicked link
            this.classList.add('active');
        });
    });
});

function showInitialAvatar(img, initial) {
    const parent = img.parentElement;
    img.remove();

    parent.innerHTML = initial;
    parent.classList.add(
        'bg-primary',
        'd-flex',
        'align-items-center',
        'justify-content-center'
    );
}

</script>