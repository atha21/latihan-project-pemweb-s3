<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
        exit;
    }
    require "koneksi.php";
    $queryread = "SELECT * FROM daftar_mahasiswa";
    $read = $connection->query($queryread);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
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
    <div class="container text-center mt-5">
        <div class="card p-3">
            <table class="table">
                <thead>
                    <tr>
                        <th class="card-header">Nama Mahasiswa</th>
                        <th class="card-header">NIM</th>
                        <th class="card-header">Program Studi</th>
                        <th class="card-header">Fakultas</th>
                        <th class="card-header">Tindakan</th>
                        <th class="card-header"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = $read->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?= $row['nama_mahasiswa'] ?></td>
                            <td><?= $row['nim_mahasiswa'] ?></td>
                            <td><?= $row['prodi_mahasiswa'] ?></td>
                            <td><?= $row['fak_mahasiswa'] ?></td>
                            <td><a href="edit.php?nim_mahasiswa=<?= $row['nim_mahasiswa']?>"><button class="btn btn-warning">edit</button></a></td>
                            <td><a href="hapus.php?nim_mahasiswa=<?= $row['nim_mahasiswa']?>"><button class="btn btn-danger">hapus</button></a></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <a href="tambah.php">
                <button class="btn btn-primary mt-2 ms-2 me-2 mb-2">Tambah Mahasiwa</button>
            </a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>