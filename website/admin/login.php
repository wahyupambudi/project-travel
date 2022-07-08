<?php
session_start();
if (isset($_SESSION["login"]))
{
    header("Location: index.php");
};

require '../func.php';

if (isset($_POST["login"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($con, "SELECT * FROM t_user WHERE email = '$email'");
    $status = mysqli_query($con, "SELECT status FROM t_user WHERE email ='$email'");
    // check email
    if (mysqli_num_rows($result) === 1)
    {
        // check password
        $row = mysqli_fetch_assoc($result);
        $sts = mysqli_fetch_assoc($status);
        // echo $row["email"];
        // echo $sts["status"];
        // $phash = password_hash('c', PASSWORD_DEFAULT);
        // echo $phash;

        if ($sts["status"] == 'on') {
          // echo $sts["status"];
          // header("Location: index.php");
          // echo true;
          if (password_verify($password, $row["password"]) && $sts["status"] === 'on' ){
            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
          } 
        } else {
          $off = true;
        }
    }
    $error = true;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/style.css">
    <title>Login Page</title>
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
                <?php if(isset($off)) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Akun Anda Belum Aktif!</strong>. Hubungi Admin.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php elseif(isset($error)): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Login Gagal</strong> Email atau Password Salah.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <h1 class="text-light">Login</h1>
                <p>Silahkan Login Untuk Masuk Ke Halaman Dashboard</p>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <button type="submit" class="btn btn-info" name="login">Login</button>
            </form>
            <div align="center">
              <p>Belum Punya Akun?</p>
              <a href="signup.php"><button class="btn btn-danger">Register</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>