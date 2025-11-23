<?php
$message = '';

if (isset($_GET['error'])) {
    $message = "<div class='alert alert-danger'>Username atau password salah.</div>";
}

$title = "Login Admin";
$customCSS = " 
    body{ background:#f6f8fb; }
    .auth-wrap { height:100vh; display:flex; align-items:center; justify-content:center; }
    .auth-card{ border-radius:18px; overflow:hidden; box-shadow:0 8px 30px rgba(8,30,60,0.12); }

    .left-pane{ background-image:url('./assets/bg.png'); background-size:cover; background-position:center; background-repeat:no-repeat; color:#fff; padding:48px 36px; min-height:420px;display:flex; flex-direction:column;
    align-items:flex-start;justify-content:center; position:relative; }

    .left-pane *{ position:relative;}

    .brand-title{ font-weight:700; font-size:22px;margin-bottom:20px;}

    .mascot{ max-width:240px; margin-top:20px; }
    .right-pane{ background:#fff; padding:42px 36px; min-height:420px; display:flex;align-items:center; justify-content:center; }
    .signin-card{ width:100%; max-width:360px; }
    .form-control{ border-radius:12px; }
    .btn-sign{ border-radius:10px; padding:10px 18px; background:#0b61a1; border:none;color:#fff; }
    .btn-sign:hover{ background:#084a80; color: #fff; }

    .logo{ height:44px; margin-bottom:14px;}

    @media (max-width:768px){
      .left-pane{
        text-align:center;
        align-items:center;
      }
      .mascot{
        max-width:150px;
      }
    }
  ";

include_once __DIR__ . '/layout/header.php';
?>
<body>
  <div class="container auth-wrap">
    <div class="auth-card card p-0">
      <div class="row g-0">
        <div class="col-md-6 left-pane">
          <h3 class="brand-title">Laboratorium<br>Software Engineering</h3>
          <p style="opacity:.9;max-width:360px">Platform internal untuk praktikum dan proyek bersama tim Software Engineering.</p>
          <img src="./assets/maskot.png" alt="mascot" class="mascot">
        </div>
        <div class="col-md-6 right-pane">
          <div class="signin-card">
            <img src="./assets/logo.png" alt="logo" class="logo">

            <h4 class="mb-3">Sign In</h4>
            <?= $message ?>

            <form action="../Controllers/authController.php" method="POST">
              <div class="mb-3">
                <input id="email" class="form-control" type="text" name="username" placeholder="Username" required>
              </div>

              <div class="mb-3">
                <input id="password" class="form-control" type="password" name="password" placeholder="Password" required>
              </div>

              <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="mailto:ardhandikri04@gmail.com" class="small">Lupa Password?</a>
              </div>

              <div class="d-grid">
                <button type="submit" name="action" value="login" class="btn btn-sign">Sign In</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once __DIR__ . '/layout/footer.php';
