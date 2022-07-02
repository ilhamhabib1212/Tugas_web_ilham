<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'db_kopinusantara';

    $conn = mysqli_connect($hostname, $username, $password, $dbname) or die ('Gagal terhubung dengan database');
?>