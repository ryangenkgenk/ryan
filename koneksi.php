<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "sekolah";

//koneksi ke database
$koneksi=mysqli_connect($host, $username, $password, $dbname);

//cek koneksi
if (!$koneksi){
    die("koneksi gagal:".mysqli_connect_error());

}
?>