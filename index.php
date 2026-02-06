<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Penjualan</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body{
            background: linear-gradient(135deg, #43cea2, #185a9d);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card{
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .login-card h3{
            font-weight: bold;
            margin-bottom: 10px;
        }
        .login-card p{
            color: #777;
            margin-bottom: 25px;
        }
        .btn-login{
            background: #185a9d;
            color: #fff;
            font-weight: bold;
        }
        .btn-login:hover{
            background: #144b82;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center">
        <i class="fas fa-store fa-3x text-primary mb-3"></i>
        <h3>Warung Sembako</h3>
        <p>Sistem Penjualan</p>
    </div>

    <?php if(isset($_GET['pesan']) && $_GET['pesan']=="gagal"){ ?>
        <div class="alert alert-danger text-center">
            Username atau Password salah!
        </div>
    <?php } ?>

    <form method="post" action="login.php">
        <div class="form-group mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username">
        </div>

        <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password">
        </div>

        <button type="submit" class="btn btn-login w-100">
            <i class="fas fa-sign-in-alt"></i> Login
        </button>
    </form>

    <div class="text-center mt-3">
        <small>© <?= date('Y'); ?> Sistem Penjualan Warung Sembako</small>
    </div>
</div>

</body>
</html>
