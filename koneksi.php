<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_db = "salsacantik";

$koneksi = mysqli_connect("localhost","root","","salsacantik");

if( !$koneksi){
    die("Gagal terhubung dengan database:" .mysqli_connect_error());
}

?>
