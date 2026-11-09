<?php
    session_start();
    require "koneksi.php";
    $error = "";

    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
        exit;
    }

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $nama_mahasiswa = $_POST['nama'];
        $nim_mahasiswa = $_POST['nim'];
        $prodi_mahasiswa = $_POST['prodi'];
        $fak_mahasiswa = $_POST['fakultas'];

        $queryinsert = "INSERT INTO daftar_mahasiswa (nama_mahasiswa, nim_mahasiswa, prodi_mahasiswa, fak_mahasiswa) VALUES (?,?,?,?)";
        $insert = $connection->prepare($queryinsert);
        $insert->bind_param("ssss", $nama_mahasiswa, $nim_mahasiswa, $prodi_mahasiswa, $fak_mahasiswa);

        if($insert->execute()){
            header("location:dashboard.php");
        }else{
            $error = "error " . $insert->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
     <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">
                <img src="" alt="logo upn" width="30" height="24">
            </a>
            <a class="navbar-brand" href="#">Daftar Mahasiswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="tambah.php">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="card shadow-sm p-4">
                <h3 class="text-center mb-5">TAMBAH MAHASISWA</h3>
                <form action="tambah.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Mahasiswa</label>
                        <input type="text" name="nama" class="form-control" placeholder="masukan nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control"  placeholder="masukan nim">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Program Studi</label>
                        <input type="text" name="prodi" class="form-control" placeholder="masukan program studi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fakultas</label>
                        <input type="text" name="fakultas" class="form-control" placeholder="masukan fakultas">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Daftar Mahasiswa</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>