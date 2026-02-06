<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

$id = $_GET['id'];

// ambil data user berdasarkan id
$data = mysqli_query($conn, "SELECT * FROM user WHERE user_id='$id'");
$user = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>

<div class="container">
    <h3 class="text-center">Edit User</h3>
    <hr>

    <form method="post" action="">
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control"
                   value="<?php echo $user['username']; ?>" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" class="form-control"
                   value="<?php echo $user['password']; ?>" required>
            <small class="text-muted">Biarkan seperti ini jika tidak ingin mengganti password</small>
        </div>

        <div class="form-group">
            <label>Nama User</label>
            <input type="text" name="user_nama" class="form-control"
                   value="<?php echo $user['user_nama']; ?>" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="user_status" class="form-control" required>
                <option value="1" <?php if ($user['user_status']=='1') echo 'selected'; ?>>Admin</option>
                <option value="2" <?php if ($user['user_status']=='2') echo 'selected'; ?>>User</option>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-warning btn-sm">
            <i class="glyphicon glyphicon-edit"></i> Update
        </button>

        <a href="user.php" class="btn btn-default btn-sm">
            <i class="glyphicon glyphicon-arrow-left"></i> Kembali
        </a>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $user_id     = $_POST['user_id'];
        $username    = $_POST['username'];
        $password    = $_POST['password'];
        $user_nama   = $_POST['user_nama'];
        $user_status = $_POST['user_status'];

        $update = mysqli_query(
            $conn,
            "UPDATE user SET
                username='$username',
                password='$password',
                user_nama='$user_nama',
                user_status='$user_status'
             WHERE user_id='$user_id'"
        );

        if ($update) {
            echo "<script>alert('Data user berhasil diupdate');window.location='user.php';</script>";
        } else {
            echo "<script>alert('Data user gagal diupdate');</script>";
        }
    }
    ?>

</div>

</body>
</html>
