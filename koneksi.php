<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "db_latihan_project";

    $connection = mysqli_connect($host,$user,$password,$db);
    if(!$connection){
        die("koneksi database gagal!" . mysqli_connect_error());
    }
?>