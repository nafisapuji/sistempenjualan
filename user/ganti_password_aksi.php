<?php
session_start();
include '../koneksi.php';

if ($_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
    exit;
}

$user_id = $_SESSION['user_id'];

$password_lama  = ($_POST['password_lama']);
$password_baru  = ($_POST['password_baru']);
$password_ulang = ($_POST['password_ulang']);

/* Cek password lama */
$cek = mysqli_query($conn,"
    SELECT * FROM user 
    WHERE user_id='$user_id'
    AND password='$password_lama'
");

if (mysqli_num_rows($cek) == 0) {
    header("location:ganti_password.php?pesan=lama_salah");
    exit;
}

/* Cek password baru */
if ($password_baru != $password_ulang) {
    header("location:ganti_password.php?pesan=tidak_sama");
    exit;
}

/* Update password */
mysqli_query($conn,"
    UPDATE user 
    SET password='$password_baru'
    WHERE user_id='$user_id'
");

/* Sukses */
header("location:ganti_password.php?pesan=berhasil");
exit;
?>