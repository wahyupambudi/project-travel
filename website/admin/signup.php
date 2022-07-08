<?php

require '../func.php';

function registrasi ($data) {
        global $con;

        $email = $data['email'];
        $username = strtolower(stripcslashes($data['username']));
        $password = $data['password'];

        // cek duplikasi email
        $result = mysqli_query($con, "SELECT email FROM t_user WHERE email = '$email'");
        if(mysqli_fetch_assoc($result)){
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // add user to database
        mysqli_query($con, "INSERT INTO t_user VALUES ('', '$email', '$username', '$password', 'off')");

        return mysqli_affected_rows($con);

    }

if(isset($_POST["register"])) {
if(registrasi ($_POST) > 0) {
$success = true;
} else {
$error = true;
echo mysqli_error($con);
}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Registrasi Page</title>

    <style>
      body {
  background-color: #ffc107;
}

.col-sm {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  width: 30%;
  padding: 20px;
}


@media screen and (max-width: 900px) {
    .col-sm {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 50%;
    padding: 20px;
  }
}

@media screen and (max-width: 600px) {
    .col-sm {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 80%;
    padding: 20px;
  }
}
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-sm rounded text-light" style="background-color: #212529">
            <form action="" method="POST">
              <div class="text-center">
                <!-- alert untuk success -->
                <?php if(isset($success)) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Registrasi Berhasil</strong> Silahkan <a href="login.php">Login</a>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
                <!-- alert untuk error -->
                <?php if(isset($error)) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Email Sudah Terdaftar </strong><a href="login.php">Login</a>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
                <h1 class="text-light">Registrasi</h1>
                <p>Silahkan Daftar dengan Email Anda!</p>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <button type="submit" class="btn btn-info" name="register">Register</button>
            </form>
            <div align="center">
              <p>Sudah Punya Akun?</p>
              <a href="login.php"><button class="btn btn-danger">Login</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>