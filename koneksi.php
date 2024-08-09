<?php 

    // NIM : 2257401057
    // NAMA : Sofiatul Ulya
    // KELAS MI22B

    $host       = "localhost";
    $user       = "root";
    $password   = "";
    $dbname     = "uas_sofiatululya";

    $koneksi    = mysqli_connect($host, $user, $password, $dbname);
    if (mysqli_connect_error()) {
        die("Koneksi Gagal Karena : ". mysqli_connect_error());
    }
?>