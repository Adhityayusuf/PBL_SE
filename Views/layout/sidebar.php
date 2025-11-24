<style>
    /*css*/
    .sidebar-custom {
        width: 270px;
        min-height: 100vh;
        background: #ffffff; 
        box-shadow: 0 0 20px rgba(0,0,0,0.08);
        padding: 25px;
        padding-top: 25px; 
        border-top-right-radius: 35px; /*rounding*/
        border-bottom-right-radius: 35px;
    }

    /*header logo*/
    .lab-header {
        text-align: center; 
        margin-bottom: 25px; 
        padding-bottom: 5px;
    }

    .lab-logo-container {
        width: 50px;
        height: 50px;
        margin: 0 auto;  
    }
    
    .lab-logo-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    /*menu*/
    .sidebar-link {
        font-size: 1.05rem;
        padding: 10px 5px;
        color: #4D4D4D;
        display: flex;
        align-items: center;
        text-decoration: none;
        margin-bottom: 5px;
    }

    .sidebar-link i {
        font-size: 1.2rem !important; 
        margin-right: 15px !important;
        width: 20px;
    }

    .sidebar-link:hover {
        color: #7a3cff;
    }
    
    .sidebar-custom hr {
        display: none;
    }
    
    .support-heading {
        font-size: 0.9rem;
        font-weight: bold;
        color: #6c757d !important;
        margin-top: 5px;
        margin-bottom: 10px;
        padding-left: 5px;
    }

    /*user footer*/
    .user-footer {
        padding-top: 15px;
        border-top: 1px solid rgba(0,0,0,0.1);
        padding-left: 5px;
    }

    .user-footer img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        object-fit: cover;
    }

    .user-info {
        margin-left: 10px;
    }

    .user-info .fw-semibold {
        font-size: 1rem;
        line-height: 1.2;
    }

    .user-info .text-muted {
        font-size: 0.85rem;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="sidebar-custom d-flex flex-column flex-shrink-0">
<div class="text-center mb-4">
<img src="../assets/logo.png" class="img-fluid">
</div>

<hr> 

    <ul class="nav nav-pills flex-column mb-auto">

        <li class="nav-item">
            <a href="/admin/profil" class="sidebar-link">
                <i class="bi bi-grid-fill fs-5"></i> Profil Lab
            </a>
        </li>

        <li class="nav-item">
            <a href="/admin/geeks" class="sidebar-link">
                <i class="bi bi-lightning-charge-fill fs-5"></i> Pengelolaan SE Geeks
            </a>
        </li>

        <li class="nav-item">
            <a href="/admin/personil" class="sidebar-link">
                <i class="bi bi-person-fill fs-5"></i> Personil
            </a>
        </li>

        <li class="nav-item">
            <a href="/admin/blog" class="sidebar-link">
                <i class="bi bi-check-square-fill fs-5"></i> Blog Artikel
            </a>
        </li>

    </ul>

    <span class="support-heading">Support</span>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="/admin/settings" class="sidebar-link">
                <i class="bi bi-gear-fill fs-5"></i> Settings
            </a>
        </li>
    </ul>

    <div class="user-footer mt-auto pt-4">
        <div class="d-flex align-items-center">
            <img src="https://ui-avatars.com/api/?name=SS&background=0D6EFD&color=fff"
                class="rounded-circle" width="40" height="40">
            <div class="user-info">
                <div class="fw-semibold">Si bro Se</div>
                <div class="text-muted small">loremadmin@labse.edu</div>
            </div>
        </div>
    </div>

</div>