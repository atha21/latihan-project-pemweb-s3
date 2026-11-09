<?php
    session_start();
    require "koneksi.php";
    $error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $querycheck = "SELECT id_user FROM daftar_user WHERE email = ?";
        $check = mysqli_prepare($connection, $querycheck);
        mysqli_stmt_bind_param($check, 's', $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if(mysqli_stmt_num_rows($check) > 0){
            $error = "email sudah digunakan!";
        }else if(strlen($password) < 8){
            $error = "passwrod kurang panjang!";
        }else{
            $passhash = password_hash($password, PASSWORD_DEFAULT);
            $queryinsert = "INSERT INTO daftar_user (username, email, password) VALUES (?,?,?)";
            $insert = mysqli_prepare($connection, $queryinsert);
            mysqli_stmt_bind_param($insert, "sss", $username, $email, $passhash);
            if(mysqli_stmt_execute($insert)){
                header("location:login.php?status=success");
                exit;
            }else{
                $error = "terjadi kesalahan registrasi!";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
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
                <h3 class="text-center mb-5">REGISTRASI</h3>
                <form action="regist.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="masukan username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="masukan email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="masukan password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrasi</button>
                </form>
                <p class="text-center mt-3 mb-1">punya akun? <a href="login.php">login</a> </p>
            </div>   
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>