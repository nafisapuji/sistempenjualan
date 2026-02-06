<!DOCTYPE html>
<html>
<head>
    <title>Ganti Password</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>

    <style>
/* ===== GLOBAL ===== */
body {
    background: linear-gradient(135deg, #e0f7fa, #e8f5e9);
    font-family: "Segoe UI", Arial, sans-serif;
}

/* ===== CARD ===== */
.card {
    max-width: 700px;
    margin: 50px auto;
    border: none;
    border-radius: 18px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    background: #ffffff;
}

/* Card header (judul) */
.card-header {
    background: linear-gradient(90deg, #00695c, #0288d1);
    color: #ffffff;
    font-weight: 700;
    font-size: 18px;
    padding: 18px 25px;
    border-radius: 18px 18px 0 0;
    letter-spacing: 1px;
}

/* Card body */
.card-body {
    padding: 30px;
}

/* ===== FORM ===== */
label {
    font-weight: 600;
    color: #004d40;
}

.form-control {
    height: 46px;
    border-radius: 10px;
    border: 1px solid #cfd8dc;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #0288d1;
    box-shadow: 0 0 0 3px rgba(2,136,209,0.15);
}

/* ===== BUTTON ===== */
.btn-group {
    display: flex;
    gap: 15px;
    margin-top: 25px;
}

.btn-primary {
    background: linear-gradient(90deg, #00695c, #0288d1);
    border: none;
    border-radius: 10px;
    font-weight: 600;
    padding: 12px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(90deg, #004d40, #0277bd);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
}

.btn-secondary {
    background: #eceff1;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    padding: 12px;
    color: #37474f;
}

.btn-secondary:hover {
    background: #cfd8dc;
}

/* ===== ALERT ===== */
.alert {
    border-radius: 10px;
    font-weight: 500;
}


    </style>
</head>
<body>

<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
    exit;
}
?>

<div class="card">
    <div class="card-header">
        GANTI PASSWORD
    </div>

    <div class="card-body" style="padding:20px">

        <!-- Pesan -->
        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "lama_salah") {
                echo "<div class='alert alert-danger'>Password lama salah!</div>";
            } elseif ($_GET['pesan'] == "tidak_sama") {
                echo "<div class='alert alert-warning'>Password baru tidak sama!</div>";
            } elseif ($_GET['pesan'] == "berhasil") {
                echo "<div class='alert alert-success'>Password berhasil diganti</div>";
            }
        }
        ?>

        <form method="post" action="ganti_password_aksi.php">
            <div class="form-group">
                <label>Password Lama</label>
                <input type="password" name="password_lama" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password_baru" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Ulangi Password Baru</label>
                <input type="password" name="password_ulang" class="form-control" required>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary btn-block">
                    Simpan
                </button>
                <a href="index.php" class="btn btn-secondary btn-block">
                    Kembali
                </a>
            </div>
        </form>

    </div>
</div>

</body>
</html>