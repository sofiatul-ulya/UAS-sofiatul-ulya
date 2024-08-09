<?php
     
    // NIM : 2257401057
    // NAMA : Sofiatul Ulya
    // KELAS MI22B

    session_start();
    session_destroy();
    session_unset();

    header('location:login.php');
?>