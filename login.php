<?php
session_start();
require_once "config/koneksi.php";

if (isset($_SESSION['username'])) {

    switch ($_SESSION['level']) {

        case 'guru':
            header("Location: guru/index.php");
            break;

        case 'siswa':
            header("Location: siswa/index.php");
            break;

        default:
            header("Location: index.php");
            break;
    }

    exit;
}

$err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == "" || $password == "") {

        $err = "Username dan Password tidak boleh kosong.";

    } else {

        $stmt = mysqli_prepare($koneksi,"
            SELECT *
            FROM users
            WHERE username=?
            LIMIT 1
        ");

        mysqli_stmt_bind_param($stmt,"s",$username);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $user = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        if($user){

              if($password == $user['password']){
                $_SESSION['id_user']  = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['level']    = $user['role'];

                switch($user['role']){

                    case "admin":
                        header("Location:index.php");
                        break;

                    case "guru":
                        header("Location:guru/index.php");
                        break;

                    case "siswa":
                        header("Location:siswa/index.php");
                        break;

                }

                exit;

            }else{

                $err = "Password salah.";

            }

        }else{

            $err = "Username tidak ditemukan.";

        }

    }

}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Sistem Akademik</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
<div class="login-logo">
    <a href="#"><b>Sistem</b> Akademik</a>
</div>    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Masuk untuk memulai sesi</p>
        <p class="text-center text-muted" style="font-size:13px">
          Admin : Username Admin<br>
          Guru : Username = Kode Guru<br>
          Siswa : Username = NIS<br>
          Password Default : 1234
</p>

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
