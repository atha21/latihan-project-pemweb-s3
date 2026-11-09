<?php
    require "koneksi.php";

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $fak = $_POST['fakultas'];

    $queryedit = "UPDATE daftar_mahasiswa set nama_mahasiswa = ?, prodi_mahasiswa = ?, fak_mahasiswa = ? WHERE nim_mahasiswa = ?";
    $edit = $connection->prepare($queryedit);
    $edit->bind_param("ssss", $nama, $prodi, $fak, $nim);
    $edit->execute();
    header('location:dashboard.php');

    $edit->close();
    $connection->close();
?>