<?php
    session_start();
    require "koneksi.php";
    $error = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $queryinsert = "SELECT id_user,username,email,password FROM daftar_user WHERE email = ?";
            $insert = mysqli_prepare($connection, $queryinsert);
            mysqli_stmt_bind_param($insert, 's', $email);
            mysqli_stmt_execute($insert);
            $user = mysqli_fetch_assoc(mysqli_stmt_get_result($insert));

            if($user && password_verify($password, $user['password'])){
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                header("location:dashboard.php");
            }else{
                $error = "email atau password salah!";
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="login.php">
                <img src="" alt="logo upn" width="30" height="24">
            </a>
            <a class="navbar-brand" href="#">Daftar Mahasiswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="card shadow-sm p-4">
                <h3 class="text-center mb-5">LOGIN DASHBOARD</h3>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="masukan email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="masukan password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <p class="text-center mt-3 mb-1">buat akun? <a href="regist.php">registrasi</a> </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>