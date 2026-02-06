<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tambah User</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>

<div class="container">
    <h3 class="text-center">Tambah User</h3>
    <hr>

    <form method="post" action="">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Nama User</label>
            <input type="text" name="user_nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="user_status" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <option value="1">Admin</option>
                <option value="2">User</option>
            </select>
        </div>

        <button type="submit" name="simpan" class="btn btn-primary btn-sm">
            <i class="glyphicon glyphicon-save"></i> Simpan
        </button>

        <a href="user.php" class="btn btn-default btn-sm">
            <i class="glyphicon glyphicon-arrow-left"></i> Kembali
        </a>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $username    = $_POST['username'];
        $password    = $_POST['password'];
        $user_nama   = $_POST['user_nama'];
        $user_status = $_POST['user_status'];

        $query = mysqli_query(
            $conn,
            "INSERT INTO user (username, password, user_nama, user_status)
             VALUES ('$username', '$password', '$user_nama', '$user_status')"
        );

        if ($query) {
            echo "<script>alert('User berhasil ditambahkan');window.location='user.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan user');</script>";
        }
    }
    ?>

</div>

</body>
</html>
