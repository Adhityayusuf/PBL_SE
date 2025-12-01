<nav class="navbar navbar-expand-lg">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand" href="index.php?action=home">
            <img src="assets/logo.png" alt="Logo">
        </a>

        <!-- Toggle untuk mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="mainNavbar">

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=home">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Profile
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?action=home#tentang-lab">Sejarah</a></li>
                        <li><a class="dropdown-item" href="index.php?action=visiMisi">Visi Misi</a></li>
                        <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=blog">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=personil">Personil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=recruitment">Recruitment</a>
                </li>
            </ul>

            <a href="index.php?action=login" class="btn btn-lab-admin">
                <i class="bi bi-lock"></i> Admin
            </a>

        </div>
    </div>
</nav>
