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
    <title>Manajemen User</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>

<div class="container">
    <h3 class="text-center">Manajemen User</h3>
    <hr>

    <a href="user_tambah.php" class="btn btn-primary btn-sm">
        <i class="glyphicon glyphicon-plus"></i> Tambah User
    </a>

    <br><br>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Status</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM user");

        while ($data = mysqli_fetch_assoc($query)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['username']; ?></td>
                <td><?= $data['user_nama']; ?></td>
                <td>
                    <?php
                    if ($data['user_status'] == '1') {
                        echo '<span class="label label-success">Admin</span>';
                    } else {
                        echo '<span class="label label-info">User</span>';
                    }
                    ?>
                </td>
                <td>
                    <a href="user_edit.php?id=<?= $data['user_id']; ?>" class="btn btn-warning btn-xs">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    <a href="user_hapus.php?id=<?= $data['user_id']; ?>" 
                       class="btn btn-danger btn-xs"
                       onclick="return confirm('Yakin ingin menghapus user ini?')">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-default btn-sm">
        <i class="glyphicon glyphicon-arrow-left"></i> Kembali
    </a>
</div>

</body>
</html>
