<?php
$server = "127.0.0.1";
$user = "root";
$password = "";
$database = "nqr";
$database2 = "lembur";
$database3 = "cmr";
$database4 = "isd";

$koneksi = mysqli_connect($server, $user, $password, $database);

$koneksi2 = mysqli_connect($server, $user, $password, $database2);

$koneksi3 = mysqli_connect($server, $user, $password, $database3);

$koneksi4 = mysqli_connect($server, $user, $password, $database4);

if (!$koneksi) {
     echo "Koneksi database gagal : " . mysqli_connect_error();
}
if (!$koneksi2) {
     echo "Koneksi database2 gagal : " . mysqli_connect_error();
}
if (!$koneksi3) {
     echo "Koneksi database3 gagal : " . mysqli_connect_error();
}
if (!$koneksi4) {
     echo "Koneksi database3 gagal : " . mysqli_connect_error();
}
?>