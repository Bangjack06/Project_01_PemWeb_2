<?php
session_start();

if (isset($_POST['submit'])) {
    require_once 'dbkoneksi.php'; // Make sure dbkoneksi.php file exists in the correct directory

    // Protect the query from SQL Injection attacks by using prepared statements
    $user = $dbh->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $user->execute([$_POST['email'], $_POST['password']]);

    $count = $user->rowCount(); // to ensure whether user exists or not
    if ($count > 0) {
        $_SESSION['user'] = $user->fetch();
        echo '<script>alert("Login Berhasil");</script>'; // Display JavaScript alert message
        echo '<script>window.location.href = "inner_page.php";</script>'; // Redirect using JavaScript
        exit; // Make sure to exit after redirecting the user to the next page
    } else { // if login fails
        echo '<script>alert("Login Gagal, Password & Email Salah");</script>'; // Display JavaScript alert message
        echo '<script>window.location.href = "login.php";</script>'; // Redirect using JavaScript
        exit; // Make sure to exit after redirecting the user back to the login page
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project 01</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../project01/login.php" class="h1"><b>Project</b>01</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>

    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>


</body>
</html>
