<?php
    require "koneksi.php";
    $nim = $_GET['nim_mahasiswa'];

    $querydelete = "DELETE FROM daftar_mahasiswa WHERE nim_mahasiswa = ?";
    $delete = $connection->prepare($querydelete);
    $delete->bind_param("s", $nim);
    $delete->execute();
    header('location:dashboard.php');

    $delete->close();
    $connection->close();
?>