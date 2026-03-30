<?php
session_start();
require_once "config/koneksi.php";

if (isset($_SESSION['Username'])) {
    header('Location: index.php');
    exit;
}

$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Username = trim($_POST['username'] ?? '');
    $Password = trim($_POST['password'] ?? '');

    if ($Username === '' || $Password === '') {
        $err = "Data tidak boleh kosong.";
    } else {
        // ✅ SESUAIKAN NAMA FIELD
        $sql = "SELECT * FROM admin WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($koneksi, $sql);

        if (!$stmt) {
            $err = "Error: " . mysqli_error($koneksi);
        } else {
            mysqli_stmt_bind_param($stmt, "s", $Username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            if ($user) {
                // ✅ CEK PASSWORD PLAINTEXT
                if ($Password === $user['password']) {
                    $_SESSION['level'] = 'admin';
                    $_SESSION['Username'] = $user['username'];
                    header('Location: index.php');
                    exit;
                } else {
                    $err = "Password salah.";
                }
            } else {
                $err = "Username tidak ditemukan.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo"><a href="#"><b>Admin</b>Panel</a></div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Masuk untuk memulai sesi</p>

        <?php if ($err !== ''): ?>
          <div class="alert alert-danger" role="alert"><?= htmlspecialchars($err) ?></div>
        <?php endif; ?>

        <form action="" method="post" novalidate>
          <div class="input-group mb-3">
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
