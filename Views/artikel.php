<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog Artikel - Roblox Age Estimation</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #032b57;
            color: white;
            margin: 0;
            padding: 0;
            padding-top: 100px;
            /* auto fix semua section */
        }

        .blog-header {
            padding-top: 150px;
            /* aman untuk fixed navbar */
        }

        .blog-header h1 {
            font-size: 48px;
            font-weight: 700;
            color: white;
        }

        .blog-header p {
            max-width: 500px;
            color: white;
            opacity: 0.8;
        }

        .category-tag {
            background: #757575ff;
            padding: 6px 14px;
            color: #000;
            display: inline-block;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        h1 {
            margin-top: 20px;
            font-size: 38px;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }
        }

        /* HERO IMAGE + SIDE TEXT layout */
        .hero-section {
            display: block;
            margin-top: 30px;
        }

        .hero-img {
            width: 100%;
            height: 380px;
            /* boleh disesuaikan */
            background: #d9d9d9;
            border-radius: 10px;
        }

        .side-text {
            font-size: 16px;
            color: #e9e9e9;
        }

        @media (max-width: 850px) {
            .hero-section {
                grid-template-columns: 1fr;
            }
        }

        .author {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .author .icon {
            width: 38px;
            height: 38px;
            background: #d9d9d9;
            border-radius: 50%;
            margin-right: 10px;
        }

        p {
            line-height: 1.7;
            margin: 18px 0;
            color: #e4e4e4;
        }

        /* IMAGE + TEXT SIDE BY SIDE (BOTTOM SECTION) */
        .bottom-flex {
            display: flex;
            gap: 30px;
            margin-top: 40px;
        }

        .bottom-img {
            flex: 1;
            background: #d9d9d9;
            height: 350px;
            border-radius: 12px;
        }

        .bottom-card {
            flex: 1;
            background: #0e3a72;
            padding: 22px;
            border-radius: 12px;
            height: fit-content;
        }

        @media (max-width: 850px) {
            .bottom-flex {
                flex-direction: column;
            }
        }

        .back-btn {
            margin-top: 40px;
            display: inline-block;
            padding: 10px 22px;
            background: white;
            color: black;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        }

        footer {
            margin-top: 90px;
            background: #001b36;
            padding: 50px 40px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            color: #ddd;
        }

        @media (max-width: 768px) {
            footer {
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <?php include '../layout/navbar.php'; ?>

    <div class="container mt-4">
        <span class="category-tag">Category 1</span>
        <h1>Roblox will require age estimation to chat starting next year</h1>

        <!-- HERO SECTION WITH IMAGE + SIDE NOTE TEXT -->
        <div class="hero-section">
            <div class="hero-img"></div>
        </div>

        <div class="author">
            <div class="icon"></div>
            <small>Mr Ironi • 08/07/2025</small>
        </div>

        <p>Roblox will soon require that users go through an age estimation process if they want to be able to chat with other people on the platform. The requirement will be in effect for all users starting in early January.</p>

        <p>Beginning in December, Roblox will require users in some markets to go through the age estimation process to be able to chat with others.</p>

        <p>After going through the age estimation process, Roblox will assign users into groups.</p>

        <!-- BOTTOM SECTION: IMAGE + CARD (LIKE FIGMA) -->
        <div class="bottom-flex">
            <div class="bottom-img"></div>

            <div class="bottom-card">
                <p><strong>Elisa (estimated age 12):</strong> Elisa has access to chat with users aged 15 or younger.</p>
                <p><strong>Marcus (estimated age 18):</strong> Marcus can chat with users 16+ and add younger siblings as Trusted Connections.</p>
            </div>
        </div>

        <a href="#" class="back-btn">Back →</a>
    </div>

    <footer>
        <div>
            <strong>Laboratorium Software Engineering</strong><br />
            Jl. Soekarno Hatta No.9, Malang
        </div>
        <div>
            <h4>Menu Cepat</h4>
            Home<br />Blog Artikel<br />Personil<br />Recruitment
        </div>
        <div>
            <h4>Kontak Kami</h4>
            labse@gmail.com<br />+62 12 1234 0000
        </div>
    </footer>
</body>

</html>