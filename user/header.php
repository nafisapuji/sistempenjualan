<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Penjualan</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
    <style>
/* ===== RESET ===== */
html, body {
    margin: 0;
    padding: 0;
}

/* ===== GLOBAL ===== */
body {
    background: linear-gradient(135deg, #e0f7fa, #e8f5e9);
    font-family: "Segoe UI", Arial, sans-serif;
}

/* ===== NAVBAR ===== */
.navbar {
    margin-bottom: 0 !important;
    border-radius: 0 !important;
}

.navbar-inverse {
    background: linear-gradient(90deg, #00695c, #0288d1);
    border: none;
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}

/* Brand */
.navbar-brand {
    color: #ffffff !important;
    font-weight: 700;
    letter-spacing: 1.5px;
}

/* ===== MENU ===== */
.navbar-inverse .navbar-nav > li > a {
    color: #e0f7fa !important;
    padding: 15px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
}

/* Hover underline */
.navbar-inverse .navbar-nav > li > a::after {
    content: "";
    position: absolute;
    bottom: 6px;
    left: 50%;
    width: 0;
    height: 3px;
    background: #ffffff;
    border-radius: 5px;
    transition: 0.3s ease;
}

.navbar-inverse .navbar-nav > li > a:hover::after,
.navbar-inverse .navbar-nav > .active > a::after {
    width: 70%;
    left: 15%;
}

.navbar-inverse .navbar-nav > li > a:hover {
    color: #ffffff !important;
}

/* Active menu */
.navbar-inverse .navbar-nav > .active > a,
.navbar-inverse .navbar-nav > .active > a:hover,
.navbar-inverse .navbar-nav > .active > a:focus {
    background: transparent;
    color: #ffffff !important;
    font-weight: 700;
}

/* ===== DROPDOWN ===== */
.dropdown-menu {
    border-radius: 14px;
    border: none;
    padding: 10px 0;
    margin-top: 10px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

.dropdown-menu > li > a {
    padding: 12px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.dropdown-menu > li > a:hover {
    background: linear-gradient(90deg, #00695c, #0288d1);
    color: #ffffff;
    padding-left: 26px;
}

/* ===== USER TEXT ===== */
.navbar-text {
    color: #ffffff !important;
    font-weight: 600;
}

/* ===== ICON ===== */
.glyphicon {
    margin-right: 6px;
    transition: transform 0.3s ease;
}

.navbar-nav > li > a:hover .glyphicon {
    transform: scale(1.15);
}


    
    </style>
</head>
  <body>

    <?php
    session_start();
    if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
        header("Location: ../index.php?pesan=belum_login");
        exit();
    }
    ?>

    <nav class="navbar navbar-inverse" style="border-radius: 0px;">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">SISTEM PENJUALAN</a>
        </div>

        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li>
              <a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a>
            </li>


            <li>
              <a href="penjualan.php"><i class="glyphicon glyphicon-shopping-cart"></i> Penjualan</a>
            </li>
            <li>
              <a href="laporan.php"><i class="glyphicon glyphicon-list-alt"></i> Laporan</a>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-cog"></i> Pengaturan <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="ganti_password.php"><i class="glyphicon glyphicon-lock"></i> Ganti Password</a>
                </li>
              </ul>
            </li>

            <li>
              <a href="../logout.php"><i class="glyphicon glyphicon-log-out"></i>Logout</a>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li>
              <p class="navbar-text">
                Halo, <b><?php echo $_SESSION['user_nama']; ?></b>
              </p>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </body>
</html>
