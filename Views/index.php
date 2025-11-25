<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lab Software Engineering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <style>
        /* =================================
           GLOBAL & UTILITY STYLES
        ================================= */
        body {
            background-color: #06315A;
            font-family: 'Poppins', sans-serif;
            color: aliceblue;
        }

        .section-title-flex {
            color: aliceblue;
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
        }

        .title-container {
            margin-bottom: 2rem;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            object-fit: contain;
            margin-right: 15px;
        }

        /* ... Navbar, About, Slider Styles (Tidak Berubah) ... */
        .navbar-custom {
            background-color: white;
            border-bottom: 3px solid #06315A;
        }

        .nav-link.active {
            border-bottom: 3px solid black;
        }

        .dropdown-menu {
            border-radius: 0;
            border: none;
            background-color: black;
            padding: 0;
            min-width: 250px;
            margin-top: 0;
        }

        .dropdown-item {
            color: white !important;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dropdown-item:hover {
            background-color: #06315A;
            color: white !important;
        }

        .about-card {
            background: #02294A;
            border-radius: 20px;
            color: white;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
        }

        .about-title {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .deskripsi-text {
            font-size: 1.15rem;
            line-height: 1.7;
            text-align: justify;
            color: white;
        }

        .maskot-img {
            max-width: 500px;
            filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.25));
        }

        #slider {
            position: relative;
            width: 100%;
            max-width: 500px;
            height: 350px;
            margin: auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        #slider img {
            width: 100%;
            height: 100%;
            position: absolute;
            object-fit: cover;
            border-radius: 10px;
        }


        /* =================================
        OWL CAROUSEL CUSTOM STYLES
        ================================= */
        .team-carousel-section {
            padding: 3rem 0;
            text-align: center;
            background-color: #06315A;
            position: relative;
        }

        /* Container untuk Owl Carousel */
        .owl-carousel {
            padding-top: 80px;
            /* Memberi ruang untuk zoom in gambar */
            padding-bottom: 80px;
            position: relative;
        }

        /* KUNCI: Membuat gambar yang di-scale tidak terpotong */
        .owl-carousel .owl-stage-outer {
            overflow: visible;
        }

        /* Styling Card Anggota Tim */
        .team-member-card {
            background: #02294A;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            transition: all 0.4s ease-in-out;
            width: 280px;
            height: 380px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            padding-bottom: 0px;
            margin: 0 auto;
            transform: scale(0.9);
            opacity: 0.7;
        }

        /* Efek Zoom in dan Opacity Penuh pada item yang aktif (di tengah) */
        .owl-carousel .owl-item.active.center .team-member-card {
            transform: scale(1.15);
            opacity: 1;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.7);
        }

        .team-member-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .team-member-info {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            width: 100%;
            padding: 0 10px 0;
            padding-top: 100px;
            background: linear-gradient(to top, rgba(2, 41, 74, 0.9) 40%, transparent 100%);

        }

        .team-member-info h5 {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .team-member-info p {
            font-size: 0.9rem;
            color: #a0aec0;
            margin-bottom: 10px;
        }

        /* KUSTOMISASI NAVIGASI (PANAH) */
        .owl-theme .owl-nav {
            /* PERBAIKAN JARAK: Menambahkan margin-top yang lebih besar */
            margin-top: 70px;
            /* Diperbesar untuk lebih banyak ruang */
            display: flex;
            justify-content: center;
        }

        /* Menyembunyikan Dots bawaan */
        .owl-theme .owl-dots {
            display: none;
        }

        /* KUSTOMISASI TOMBOL PANAH */
        .owl-theme .owl-nav button {
            background-color: white !important;
            border: none;
            border-radius: 50% !important;
            width: 50px;
            height: 50px;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
            margin: 0 10px;
            color: #06315A !important;
            font-size: 1.5rem !important;
            opacity: 1 !important;
        }

        .owl-theme .owl-nav button:hover {
            background-color: #f0f0f0 !important;
        }

        /* PERBAIKAN ARAH PANAH */
        .owl-theme .owl-nav button.owl-prev:before {
            content: "\f284";
            font-family: "bootstrap-icons";
        }

        /* bi-chevron-left */
        .owl-theme .owl-nav button.owl-next:before {
            content: "\f285";
            font-family: "bootstrap-icons";
        }

        /* bi-chevron-right */
        .owl-theme .owl-nav button span {
            display: none;
        }

        /* Menyembunyikan teks bawaan "Prev", "Next" */

        /* Tombol Lihat Data Dosen */
        .btn-data-dosen {
            background-color: white;
            color: black;
            border: none;
            padding: 10px 30px;
            border-radius: 5px;
            font-weight: 600;
            margin-top: 50px;
            /* Jarak dari Panah ke Tombol Dosen */
            transition: background-color 0.3s;
        }

        .btn-data-dosen:hover {
            background-color: #ccc;
            color: black;
        }

        /* =================================
        CUSTOM BLOG CARD STYLES
        (Untuk menyesuaikan dengan desain abu-abu di gambar)
        ================================= */
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


        /* =================================
        ROADMAP CUSTOM STYLES (ZIG-ZAG TIMELINE)
        ================================= */

        /* Container Utama Timeline */
        .roadmap-timeline {
            position: relative;
            padding: 0;
        }

        /* Garis Vertikal Tengah (Hanya terlihat di layar besar) */
        .roadmap-timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 3px;
            /* Garis lebih tebal */
            background-color: #02294A;
            /* Warna garis (biru tua gelap) */
            margin-left: -1.5px;
            z-index: 1;
            display: none;
            /* Default disembunyikan untuk mobile */
        }

        /* Tampilkan garis di desktop */
        @media (min-width: 768px) {
            .roadmap-timeline::before {
                display: block;
            }
        }

        /* Kartu Fase Roadmap (Wrapper) */
        .roadmap-item {
            padding: 10px 0;
            position: relative;
            width: 100%;
        }

        /* Kartu Fisik */
        .card-custom {
            background: #02294A;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            position: relative;
            margin: 10px 0;
            z-index: 2;
            text-align: left;
            transition: transform 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .card-custom h5 {
            color: #FFC107;
            font-size: 1.35rem;
            /* Ukuran font lebih besar */
            font-weight: 700;
            margin-bottom: 10px;
        }

        .card-custom p.small {
            font-size: 0.95rem;
            line-height: 1.6;
            color: aliceblue;
        }

        /* ------------------------------------- */
        /* Penempatan dan Titik Timeline (Desktop) */
        /* ------------------------------------- */
        @media (min-width: 768px) {
            .roadmap-item {
                width: 50%;
            }

            /* Titik Noda di Garis Tengah */
            .roadmap-item::after {
                content: '';
                position: absolute;
                width: 18px;
                /* Ukuran titik lebih besar */
                height: 18px;
                background-color: #FFC107;
                /* Warna kuning */
                border: 4px solid #06315A;
                /* Border tebal warna body */
                top: 30px;
                border-radius: 50%;
                z-index: 3;
            }

            /* Penempatan Item Ganjil (Kiri) */
            .roadmap-item:nth-child(odd) {
                float: left;
                clear: both;
                /* Memaksa ke baris baru */
                padding-right: 30px;
                text-align: right;
            }

            .roadmap-item:nth-child(odd) .card-custom {
                margin-right: 30px;
            }

            .roadmap-item:nth-child(odd)::after {
                right: -9px;
                /* Pas di garis tengah */
            }

            .roadmap-item:nth-child(odd) h5,
            .roadmap-item:nth-child(odd) p.small {
                text-align: right;
            }

            /* Penempatan Item Genap (Kanan) */
            .roadmap-item:nth-child(even) {
                float: right;
                clear: both;
                /* Memaksa ke baris baru */
                padding-left: 30px;
                text-align: left;
            }

            .roadmap-item:nth-child(even) .card-custom {
                margin-left: 30px;
            }

            .roadmap-item:nth-child(even)::after {
                left: -9px;
                /* Pas di garis tengah */
            }
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .owl-carousel {
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .owl-carousel .owl-item .team-member-card {
                transform: scale(1);
            }

            .owl-carousel .owl-item.active.center .team-member-card {
                transform: scale(1);
            }

            .owl-theme .owl-nav {
                display: none;
                /* Sembunyikan navigasi di mobile jika diinginkan */
            }
        }

        /* =================================
            FOCUS & SCOPE CUSTOM STYLES
        ================================= */
        .icon-box {
            /* Atur sebagai Flexbox untuk menengahkan ikon */
            display: inline-flex;
            align-items: center;
            justify-content: center;
            /* Properti Bentuk Lingkaran */
            width: 80px;
            /* Ukuran lingkaran */
            height: 80px;
            /* Ukuran lingkaran */
            border-radius: 50%;
            /* Membuat bentuk lingkaran */
            background-color: #02294A;
            /* Warna latar belakang lingkaran (lebih gelap dari body) */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            /* Posisikan ikon di tengah lingkaran */
            margin-bottom: 10px;
        }

        .icon-box i {
            /* Menyesuaikan ukuran ikon */
            font-size: 2.5rem !important;
            /* Ukuran ikon diperbesar sedikit */
            color: #FFC107 !important;
            /* Pastikan warna ikon sesuai (kuning/warning) */
        }
    </style>

    <script>
        let i = 1; // harus di luar agar global

        $(document).ready(function() {
            // Sembunyikan semua gambar kecuali yang pertama
            $('#sliderImage2').hide();
            $('#sliderImage3').hide();

            // Mulai slideshow setiap 3 detik
            setInterval(showNextImage, 3000);

            // INISIASI OWL CAROUSEL (tidak diubah)
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 50,
                nav: true,
                dots: false,
                center: true,
                responsive: {
                    0: {
                        items: 1,
                        margin: 10,
                        center: false
                    },
                    768: {
                        items: 3,
                        margin: 30
                    },
                    1200: {
                        items: 3,
                        margin: 50
                    }
                }
            });
        });

        function showNextImage() {
            let totalImages = 3;

            // gambar sekarang fade out
            $('#sliderImage' + i).fadeOut(1000, function() {
                i++;
                if (i > totalImages) i = 1; // reset

                // gambar berikut fade in
                $('#sliderImage' + i).fadeIn(1000);
            });
        }
    </script>

</head>

<body>
    <section class="container py-5 text-center">
        <h2 class="fw-bold fs-3">Welcome To</h2>
        <h1 class="fw-bold fs-1">Laboratorium Software Engineering</h1>
        <h1 class="fw-bold text-warning fs-2">Jurusan Teknologi Informasi</h1>
        <br><br>
        <p class="text-light fs-5">“Di Lab Software Engineering, ide menjadi solusi, dan kode menjadi karya. Di sinilah masa depan software dimulai.”</p>
    </section>

    <hr class="my-5 opacity-25">

    <section id="tentang-lab" class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 text-center">
                    <img src="assets/maskot.png" class="img-fluid maskot-img" alt="Maskot Lab SE">
                </div>

                <div class="col-lg-5 col-md-6">
                    <div class="about-card p-5">
                        <h2 class="about-title mb-4 text-center">Tentang Lab</h2>
                        <p class="deskripsi-text">
                            Lab Software Engineering merupakan salah satu laboratorium di bawah Jurusan Teknologi Informasi,
                        Politeknik Negeri Malang. Fokus utama kami adalah pengembangan perangkat lunak berbasis rekayasa sistem,
                        pemrograman, dan manajemen proyek. Melalui kegiatan praktikum, riset, dan proyek kolaboratif, Lab Software
                        Engineering menjadi wadah bagi mahasiswa untuk belajar menerapkan prinsip **software engineering** secara nyata —
                        mulai dari analisis kebutuhan, perancangan, hingga implementasi dan pengujian aplikasi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5 opacity-25">

    <section class="container py-5">
        <div class="row align-items-center justify-content-center">

            <div class="col-md-6 order-md-2">
                <h2 class="fw-bold section-title-flex text-md-start mb-4">Achievements</h2>
                <div class="achievement-card">
                    <p class="deskripsi-text">
                        Lab Software Engineering merupakan salah satu laboratorium di bawah Jurusan Teknologi Informasi,
                        Politeknik Negeri Malang. Fokus utama kami adalah pengembangan perangkat lunak berbasis rekayasa sistem,
                        pemrograman, dan manajemen proyek. Melalui kegiatan praktikum, riset, dan proyek kolaboratif, Lab Software
                        Engineering menjadi wadah bagi mahasiswa untuk belajar menerapkan prinsip Software Engineering secara nyata —
                        mulai dari analisis kebutuhan, perancangan, hingga implementasi dan pengujian aplikasi.
                    </p>
                </div>
            </div>

            <div class="col-md-6 order-md-1 mt-4 mt-md-0 text-left">
                <div id="slider">
                    <img id="sliderImage1" src="assets/acv1.jpg" alt="Achievement 1">
                    <img id="sliderImage2" src="assets/acv2.jpg" alt="Achievement 2">
                    <img id="sliderImage3" src="assets/acv3.jpg" alt="Achievement 3">
                </div>
            </div>

        </div>
    </section>

    <hr class="my-5 opacity-25">

    <section id="personil-section" class="team-carousel-section">

        <div class="title-container d-flex justify-content-center align-items-center">
            <img src="assets/our_team.png" class="section-icon" alt="Our Team Icon">
            <h2 class="section-title-flex">OUR TEAM</h2>
        </div>

        <div class="owl-carousel owl-theme">
            <div class="item">
                <div class="team-member-card">
                    <img src="assets/personil1.jpg" alt="Person 1">
                    <div class="team-member-info">
                        <h5>Nama Anggota 1</h5>
                        <p>Jabatan Anggota 1</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="team-member-card">
                    <img src="assets/personil2.jpg" alt="Person 2">
                    <div class="team-member-info">
                        <h5>Nama Anggota 2</h5>
                        <p>Jabatan Anggota 2</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="team-member-card">
                    <img src="assets/personil3.jpg" alt="Person 3">
                    <div class="team-member-info">
                        <h5>Nama Anggota 3</h5>
                        <p>Jabatan Anggota 3</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="team-member-card">
                    <img src="assets/personil4.jpg" alt="Person 4">
                    <div class="team-member-info">
                        <h5>Nama Anggota 4</h5>
                        <p>Jabatan Anggota 4</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="team-member-card">
                    <img src="assets/personil5.jpg" alt="Person 5">
                    <div class="team-member-info">
                        <h5>Nama Anggota 5</h5>
                        <p>Jabatan Anggota 5</p>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-data-dosen">Lihat Data Dosen</a>

    </section>

    <hr class="my-5 opacity-25">

    <section id="focus-scope-section" class="container py-5 text-center">
        <h2 class="section-title-flex mb-4">Focus dan Scope Penelitian</h2>
        <div class="row g-4 justify-content-center mt-5">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="icon-box">
                    <i class="bi bi-code-slash text-warning"></i>
                </div>
                <p class="text-light mt-2">Web Development</p>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="icon-box">
                    <i class="bi bi-phone text-warning"></i>
                </div>
                <p class="text-light mt-2">Mobile Development</p>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="icon-box">
                    <i class="bi bi-bug text-warning"></i>
                </div>
                <p class="text-light mt-2">Software Testing</p>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="icon-box">
                    <i class="bi bi-gear text-warning"></i>
                </div>
                <p class="text-light mt-2">Software Process & Methodology</p>
            </div>
        </div>
    </section>

    <hr class="my-5 opacity-25">

    <section id="roadmap-section" class="container py-5">
        <h2 class="section-title-flex mb-5 text-center">Roadmap Lab SE</h2>
        <div class="roadmap-timeline clearfix">

            <div class="roadmap-item">
                <div class="card-custom">
                    <h5>2024 - Tahap Awal 🚀</h5>
                    <p class="small">Fokus pada penguatan dasar-dasar pemrograman dan *Software Development Life Cycle* (SDLC). Mencakup materi fundamental **Web** dan **Database**.</p>
                </div>
            </div>

            <div class="roadmap-item">
                <div class="card-custom">
                    <h5>2025 - Tahap Pengembangan 📱</h5>
                    <p class="small">Mulai eksplorasi ke ranah **Mobile Development** dan **Software Testing** tingkat lanjut. Proyek kolaboratif dengan industri dimulai, menerapkan metodologi Agile/Scrum.</p>
                </div>
            </div>

            <div class="roadmap-item">
                <div class="card-custom">
                    <h5>2026 - Tahap Inovasi ⚙️</h5>
                    <p class="small">Riset mendalam di bidang **Software Architecture** (Microservices, Serverless) dan implementasi **DevOps** (CI/CD pipeline, containerization). Fokus pada proyek akhir riset dengan dampak luas.</p>
                </div>
            </div>

            <div class="roadmap-item">
                <div class="card-custom">
                    <h5>2027+ - Ekspansi Global 🌍</h5>
                    <p class="small">Memperluas jangkauan penelitian ke bidang Machine Learning/AI dalam Software Engineering dan membangun kerjasama internasional untuk publikasi dan proyek bersama.</p>
                </div>
            </div>

        </div>
    </section>

    <hr class="my-5 opacity-25">

    <section id="blog-section" class="container py-5">
        <h2 class="section-title-flex mb-5 text-center">Blog Artikel Terkini</h2>
        <div class="row g-4 mt-5 pb-5">

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<?php include_once __DIR__ . '/layout/footer.php';