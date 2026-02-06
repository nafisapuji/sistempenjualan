<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Penjualan</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
</head>
<body>
<?php
	session_start();
	if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
		header("location:../index.php?pesan=belum_login");
		exit;
	}
	include '../koneksi.php';
?>

<div class="col-md-10 col-md-offset-1">
<?php
	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	if ($id <= 0) die("ID invoice tidak valid.");

	// Ambil data penjualan + barang + user (kasir)
	$jual = mysqli_query($conn, "
		SELECT
			p.id_jual,
			p.tgl_jual,
			p.jumlah,
			p.total_harga,
			b.nama_barang,
			b.harga_jual,
			u.user_nama
		FROM penjualan p
		JOIN barang b ON p.id_barang = b.id_barang
		JOIN user u ON p.user_id = u.user_id
		WHERE p.id_jual = '$id'
		LIMIT 1
	");

	if (!$jual || mysqli_num_rows($jual) == 0) {
		die("Data penjualan tidak ditemukan.");
	}

	$d = mysqli_fetch_assoc($jual);

	$qty   = (int)$d['jumlah'];
	$harga = (int)$d['harga_jual'];

	$total = (int)$d['total_harga'];
	if ($total <= 0) {
		$total = $qty * $harga; // fallback kalau total_harga kosong
	}
?>

	<center>
		<h2>PENJUALAN RPL</h2>
	</center>

	<table class="table">
		<tr>
			<th width="20%">No. Invoice</th>
			<th>:</th>
			<th>INVOICE-<?php echo $d['id_jual']; ?></th>
		</tr>
		<tr>
			<th width="20%">Tgl. Jual</th>
			<th>:</th>
			<th><?php echo $d['tgl_jual']; ?></th>
		</tr>
		<tr>
			<th>Kasir</th>
			<th>:</th>
			<th><?php echo $d['user_nama']; ?></th>
		</tr>
		<tr>
			<th>Total Harga</th>
			<th>:</th>
			<th><?php echo "Rp." . number_format($total); ?></th>
		</tr>
	</table>

	<br>

	<h4 class="text-center">Detail Barang</h4>
	<table class="table table-bordered table-striped">
		<tr>
			<th>Nama Barang</th>
			<th width="20%" class="text-center">Jumlah</th>
			<th width="20%" class="text-right">Harga Jual</th>
			<th width="20%" class="text-right">Total</th>
		</tr>
		<tr>
			<td><?php echo htmlspecialchars($d['nama_barang']); ?></td>
			<td class="text-center"><?php echo $qty; ?></td>
			<td class="text-right"><?php echo "Rp." . number_format($harga); ?></td>
			<td class="text-right"><?php echo "Rp." . number_format($total); ?></td>
		</tr>
	</table>

	<br>
	<p><center><i>"Terima Kasih Atas Pembelian Anda"</i></center></p>

</div>

<script type="text/javascript">
	window.print();
</script>
</body>
</html>
