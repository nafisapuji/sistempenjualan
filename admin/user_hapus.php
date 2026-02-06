<?php
session_start();
include '../koneksi.php';

// cek login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

// ambil id user dari URL
$id = $_GET['id'];

// cegah user menghapus akunnya sendiri
if ($id == $_SESSION['user_id']) {
    echo "<script>
            alert('Tidak bisa menghapus akun yang sedang login!');
            window.location='user.php';
          </script>";
    exit();
}

// proses hapus
$hapus = mysqli_query($conn, "DELETE FROM user WHERE user_id='$id'");

if ($hapus) {
    echo "<script>
            alert('Data user berhasil dihapus');
            window.location='user.php';
          </script>";
} else {
    echo "<script>
            alert('Data user gagal dihapus');
            window.location='user.php';
          </script>";
}
?>
