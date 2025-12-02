<footer class="custom-footer">
    <style>
        .custom-footer {
            background-color: #011E39;
            padding: 60px 0 20px 0;
            color: #a0aec0;
        }

        .custom-footer .footer-logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .custom-footer .footer-logo-container img {
            width: 60px;
            height: 60px;
            margin-right: 15px;
        }

        .custom-footer .footer-logo-text {
            color: white;
            line-height: 1.2;
        }

        .custom-footer .footer-logo-text .lab-name {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .custom-footer .contact-info {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .custom-footer .contact-info i {
            color: white;
            font-size: 1.1rem;
            margin-right: 10px;
            padding-top: 3px;
        }

        .custom-footer .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin-right: 20px;
            transition: color 0.3s;
        }

        .custom-footer .social-icons a:hover {
            color: #FFC107;
        }

        .custom-footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .custom-footer .menu-link {
            display: block;
            color: #a0aec0;
            text-decoration: none;
            margin-bottom: 8px;
            transition: color 0.3s;
        }

        .custom-footer .menu-link:hover {
            color: white;
        }

        .custom-footer .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 40px;
            font-size: 0.9rem;
        }
    </style>

    <div class="container">
        <div class="row mb-5 social-icons">
            <div class="col-12">
                <a href="#!" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#!" aria-label="Youtube"><i class="bi bi-youtube"></i></a>
                <a href="#!" aria-label="X (Twitter)"><i class="bi bi-twitter-x"></i></a>
                <a href="#!" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                <a href="#!" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6 col-lg-6 mb-4">
                <div class="footer-logo-container">
                    <img src="assets/maskot.png" alt="Lab SE Logo" class="img-fluid">
                    <div class="footer-logo-text">
                        <span class="lab-name d-block">Laboratorium</span>
                        <span class="lab-name d-block">Software Engineering</span>
                    </div>
                </div>

                <div class="contact-info mt-3">
                    <i class="bi bi-geo-alt-fill"></i>
                    <p class="mb-0">
                        Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang <br>
                        Jawa Timur 65141
                    </p>
                </div>
            </div>

            <div class="col-md-3 col-lg-3 mb-4">
                <h5>Menu Cepat</h5>
                <a href="#tentang-lab" class="menu-link">Home</a>
                <a href="#tentang-lab" class="menu-link">Visi Misi</a>
                <a href="#blog-section" class="menu-link">Blog Artikel</a>
                <a href="#personil-section" class="menu-link">Personil</a>
                <a href="#recruitment-section" class="menu-link">Recruitment</a>
            </div>

            <div class="col-md-3 col-lg-3 mb-4">
                <h5>Kontak Kami</h5>
                <div class="contact-info">
                    <i class="bi bi-envelope-fill"></i>
                    <p class="mb-0">labse@gmail.com</p>
                </div>
                <div class="contact-info">
                    <i class="bi bi-telephone-fill"></i>
                    <p class="mb-0">+62 12 1234 0000</p>
                </div>
                <div class="contact-info">
                    <i class="bi bi-send-fill"></i>
                    <p class="mb-0">
                        Lantai 8 Gedung Sipil <br>
                        Politeknik Negeri Malang
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start copyright">
                &copy; 2025 Lab Multimedia Software Engineering. Semua hak cipta dilindungi.
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
        let i = 1; 
        function showNextImage() {
            $("#sliderImage" + i).fadeOut(500);
            i = (i % 3) + 1;
            $("#sliderImage" + i).fadeIn(500);
        }

        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                center: true,
                responsive: {
                    0: { items: 1, center: false },
                    768: { items: 3, margin: 30 }
                }
            });

            $("#sliderImage2").hide();
            $("#sliderImage3").hide();
            setInterval(showNextImage, 3000);
        });
    </script>

</html>