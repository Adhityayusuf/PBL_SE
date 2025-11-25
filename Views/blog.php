<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog Artikel - Bootstrap Version</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <style>
            body {
                background: #06213D;
                font-family: Poppins, sans-serif;
            }

            header {
                width: 100%;
                padding: 18px 40px;
                background: white;
                display: flex;
                align-items: center;
                justify-content: space-between;
                color: black;
            }

            header .menu a {
                margin: 0 12px;
                color: black;
                text-decoration: none;
                font-weight: 500;
            }


            /* Responsive header */
            @media (max-width: 768px) {
                header {
                    flex-direction: column;
                    gap: 12px;
                    padding: 18px;
                }

                header .menu {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                }
            }

            .filter-btn {
                border-radius: 20px;
            }

            .search-input {
                border-radius: 20px;
            }

            .card-custom {
                border-radius: 15px;
                overflow: hidden;
            }

            .card-img-top {
                height: 150px;
                background: #dcdcdc;
            }

            footer {
                background: #06213D;
                padding: 50px 0;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
                color: white;
            }

            .blog-card-custom {
                background-color: #F8F8F8;
                /* Latar belakang abu-abu terang */
                border-radius: 15px;
                padding: 0;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                height: 100%;
                /* Memastikan semua kartu memiliki tinggi yang sama di dalam row */
                display: flex;
                flex-direction: column;
            }

            .blog-card-header {
                height: 120px;
                background-color: #EFEFEF;
                /* Latar belakang placeholder gambar */
                /* Menambahkan elemen grafis seperti di desain */
                background-image: url('placeholder_wave.svg');
                /* Ganti dengan gambar wave SVG Anda */
                background-size: cover;
                background-position: center;
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
                position: relative;
                margin-bottom: 15px;
            }

            .blog-card-body {
                padding: 0 20px 20px 20px;
                color: #06315A;
                /* Warna teks gelap */
                flex-grow: 1;
                /* Memastikan body mengisi sisa ruang */
                display: flex;
                flex-direction: column;
            }

            .blog-card-meta {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }

            .blog-card-meta .category-tag {
                background-color: #06315A;
                color: white;
                font-size: 0.75rem;
                font-weight: 600;
                padding: 3px 8px;
                border-radius: 5px;
            }

            .blog-card-body h5 {
                color: #06315A;
                font-weight: 700;
                line-height: 1.3;
                margin-bottom: 10px;
                font-size: 1.15rem;
            }

            .blog-card-body p.snippet {
                font-size: 0.9rem;
                color: #4A5568;
                margin-bottom: 15px;
                flex-grow: 1;
                /* Memungkinkan cuplikan mengambil ruang yang bervariasi */
            }

            .blog-card-body .read-now {
                font-weight: 600;
                color: #06315A;
                text-decoration: underline;
                margin-bottom: 15px;
            }

            .blog-card-footer {
                display: flex;
                align-items: center;
                padding: 10px 20px;
                border-top: 1px solid #E2E8F0;
                background-color: #F8F8F8;
                /* Latar belakang abu-abu terang */
            }

            .blog-card-footer i {
                font-size: 1.5rem;
                color: #06315A;
                margin-right: 8px;
            }

            .blog-card-footer .author-name {
                font-size: 0.9rem;
                color: #4A5568;
                font-weight: 600;
            }
        </style>
    </head>

    <body>

    

        <div class="container blog-header">
            <div class="d-flex align-items-center justify-content-between">

                <!-- KIRI: JUDUL + DESKRIPSI -->
                <div>
                    <h1>Blog Artikel</h1>
                    <p style="max-width: 420px;">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit quisque faucibus ex sapien vitae pellentesque sem placerat...
                    </p>
                </div>

                <!-- KANAN: MASCOT -->
                <img src="assets/mascot.png"
                    alt="Mascot"
                    style="width:250px; height:250px; object-fit:cover; transform: scaleX(-1);">
            </div>

            <!-- FILTER + SEARCH -->
            <div class="d-flex align-items-center gap-2 mt-4">
                <button class="btn btn-dark filter-btn">All Article</button>
                <button class="btn btn-outline-light filter-btn">Category 1</button>
                <button class="btn btn-outline-light filter-btn">Category 2</button>
                <div class="ms-auto">
                    <input type="text" placeholder="Search" class="form-control search-input px-3">
                </div>
            </div>

            <!-- CARDS -->
            <section id="blog-section" class="container pt-2 pb-4">
                <div class="row g-4 mt-5">

                    <div class="col-md-4">
                        <div class="blog-card-custom">
                            <div class="blog-card-header"></div>

                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <span class="category-tag">Category 1</span>
                                    <span class="date-info" style="font-size: 0.85rem; color: #4A5568;">08/07/2025</span>
                                </div>

                                <h5>Membangun pipeline CI/CD untuk proyek kampus</h5>
                                <p class="snippet">Langkah praktis membangun CI/CD menggunakan GitHub Action dan Docker.</p>

                                <a href="#" class="read-now">Read Now</a>
                            </div>

                            <div class="blog-card-footer">
                                <i class="bi bi-person-circle"></i>
                                <span class="author-name">Mr.ironi</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="blog-card-custom">
                            <div class="blog-card-header"></div>
                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <span class="category-tag">Category 2</span>
                                    <span class="date-info" style="font-size: 0.85rem; color: #4A5568;">08/07/2025</span>
                                </div>
                                <h5>Membangun pipeline CI/CD untuk proyek kampus</h5>
                                <p class="snippet">Langkah praktis membangun CI/CD menggunakan GitHub Action dan Docker.</p>
                                <a href="#" class="read-now">Read Now</a>
                            </div>
                            <div class="blog-card-footer">
                                <i class="bi bi-person-circle"></i>
                                <span class="author-name">Mr.ironi</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="blog-card-custom">
                            <div class="blog-card-header"></div>
                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <span class="category-tag">Category 3</span>
                                    <span class="date-info" style="font-size: 0.85rem; color: #4A5568;">08/07/2025</span>
                                </div>
                                <h5>Membangun pipeline CI/CD untuk proyek kampus</h5>
                                <p class="snippet">Langkah praktis membangun CI/CD menggunakan GitHub Action dan Docker.</p>
                                <a href="#" class="read-now">Read Now</a>
                            </div>
                            <div class="blog-card-footer">
                                <i class="bi bi-person-circle"></i>
                                <span class="author-name">Mr.ironi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-data-dosen">Lihat lebih banyak</a>
                </div>
            </section>

            <section id="blog-section" class="container pt-1 pb-2">
                <div class="row g-4 pb-5">

                    <div class="col-md-4">
                        <div class="blog-card-custom">
                            <div class="blog-card-header"></div>

                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <span class="category-tag">Category 1</span>
                                    <span class="date-info" style="font-size: 0.85rem; color: #4A5568;">08/07/2025</span>
                                </div>

                                <h5>Membangun pipeline CI/CD untuk proyek kampus</h5>
                                <p class="snippet">Langkah praktis membangun CI/CD menggunakan GitHub Action dan Docker.</p>

                                <a href="#" class="read-now">Read Now</a>
                            </div>

                            <div class="blog-card-footer">
                                <i class="bi bi-person-circle"></i>
                                <span class="author-name">Mr.ironi</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="blog-card-custom">
                            <div class="blog-card-header"></div>
                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <span class="category-tag">Category 2</span>
                                    <span class="date-info" style="font-size: 0.85rem; color: #4A5568;">08/07/2025</span>
                                </div>
                                <h5>Membangun pipeline CI/CD untuk proyek kampus</h5>
                                <p class="snippet">Langkah praktis membangun CI/CD menggunakan GitHub Action dan Docker.</p>
                                <a href="#" class="read-now">Read Now</a>
                            </div>
                            <div class="blog-card-footer">
                                <i class="bi bi-person-circle"></i>
                                <span class="author-name">Mr.ironi</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="blog-card-custom">
                            <div class="blog-card-header"></div>
                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <span class="category-tag">Category 3</span>
                                    <span class="date-info" style="font-size: 0.85rem; color: #4A5568;">08/07/2025</span>
                                </div>
                                <h5>Membangun pipeline CI/CD untuk proyek kampus</h5>
                                <p class="snippet">Langkah praktis membangun CI/CD menggunakan GitHub Action dan Docker.</p>
                                <a href="#" class="read-now">Read Now</a>
                            </div>
                            <div class="blog-card-footer">
                                <i class="bi bi-person-circle"></i>
                                <span class="author-name">Mr.ironi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-data-dosen">Lihat lebih banyak</a>
                </div>
            </section>
            <!-- PAGINATION -->
            <nav class="mt-5 d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link">&lt;</a></li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">3</a></li>
                    <li class="page-item"><a class="page-link">&gt;</a></li>
                </ul>
            </nav>
        </div>

        <!-- FOOTER -->
        <footer class="mt-5">
            <div class="container d-flex flex-wrap justify-content-between">
                <div class="mb-3">
                    <h5>Laboratorium Software Engineering</h5>
                    <p>Jl. Soekarno Hatta No.9, Malang</p>
                </div>
                <div class="mb-3">
                    <h5>Menu Cepat</h5>
                    <p>Home</p>
                    <p>Blog Artikel</p>
                    <p>Personil</p>
                    <p>Recruitment</p>
                </div>
                <div class="mb-3">
                    <h5>Kontak</h5>
                    <p>Email: labse@gmail.com</p>
                    <p>Telp: +62 812 1234 0000</p>
                    <p>Alamat: Politeknik Negeri Malang</p>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>