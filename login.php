<?php
session_start();
include 'koneksi.php';

$input    = $_POST['username'];
$password = $_POST['password'];

if (empty($input) || empty($password)) {
    header("Location: index.php?pesan=gagal");
    exit();
}

$sql = "SELECT * FROM `user` WHERE username='$input'";
$data = mysqli_query($conn, $sql);

if (mysqli_num_rows($data) > 0) {
    $user = mysqli_fetch_assoc($data);

    if ($password == $user['password']) {

        $_SESSION['user_id']     = $user['user_id'];
        $_SESSION['username']    = $user['username'];
        $_SESSION['user_nama']   = $user['user_nama'];
        $_SESSION['user_status'] = $user['user_status'];
        $_SESSION['status']      = "login";

        if ($user['user_status'] == '1') {
            header("Location: admin/index.php");
        } elseif ($user['user_status'] == '2') {
            header("Location: user/index.php");
        }
        exit();

    } else {
        header("Location: index.php?pesan=gagal");
        exit();
    }
} else {
    header("Location: index.php?pesan=gagal");
    exit();
}
?>
