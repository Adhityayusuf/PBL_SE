<?php
$title = "Login Page";

require_once __DIR__ .  '/../Core/Database.php';
require_once __DIR__ . '/../Models/AdminModel.php';
require_once __DIR__ . '/../Controllers/authController.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $authController = new authController();
    $user = $authController->login($username, $password);

    if ($user) {
        $message = "<div class='alert alert-success'>Login berhasil!</div>";
        header("Location: admin/home.php");
    } else {
        $message = "<div class='alert alert-danger'>Username atau password salah.</div>";
    }
}

require_once __DIR__ . '/../views/layout/header.php';

?>

<div class="container" style="max-width: 400px; margin-top: 50px;">
    <h3 class="mb-3">Login</h3>

    <?= $message ?>

    <form action="" method="POST">
        <div class="form-group mb-3">
            <label for="username">Username</label>
            <input 
                type="text" 
                class="form-control" 
                id="username" 
                name="username" 
                required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password" 
                required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

<?php include __DIR__ . '/../views/layout/footer.php'; ?>
