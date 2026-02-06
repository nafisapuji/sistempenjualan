<!DOCTYPE html>
<html>
<head>
	<title>Invoice Penjualan</title>
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

	$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	if ($id <= 0) die("ID invoice tidak valid.");

	// Ambil data penjualan + barang + user (kasir)
	$q = mysqli_query($conn, "
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

	if (!$q || mysqli_num_rows($q) == 0) {
		die("Data penjualan tidak ditemukan.");
	}

	$d = mysqli_fetch_assoc($q);

	$qty   = (int)$d['jumlah'];
	$harga = (int)$d['harga_jual'];

	// jika total_harga kosong / 0, hitung otomatis
	$total = (int)$d['total_harga'];
	if ($total <= 0) {
		$total = $qty * $harga;
	}
?>
<div class="col-md-10 col-md-offset-1">

	<center>
		<h2>PENJUALAN SEMBAKO</h2>
		
	</center>

	<a href="penjualan_invoice_cetak.php?id=<?php echo $id; ?>" target="_blank" class="btn btn-primary pull-right">
		<i class="glyphicon glyphicon-print"></i> Cetak
	</a>

	<br><br>

	<table class="table">
		<tr>
			<th width="20%">No. Invoice</th>
			<th>:</th>
			<th>INV-<?php echo $d['id_jual']; ?></th>
		</tr>
		<tr>
			<th width="20%">Tanggal</th>
			<th>:</th>
			<th><?php echo $d['tgl_jual']; ?></th>
		</tr>
		<tr>
			<th>Kasir</th>
			<th>:</th>
			<th><?php echo $d['user_nama']; ?></th>
		</tr>
	</table>

	<h4 class="text-center">Detail Barang</h4>
	<table class="table table-bordered table-striped">
		<tr>
			<th>Nama Barang</th>
			<th width="15%" class="text-center">Jumlah</th>
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

	<table class="table">
		<tr>
			<th class="text-right" width="80%">Grand Total</th>
			<th class="text-right"><b><?php echo "Rp." . number_format($total); ?></b></th>
		</tr>
	</table>

	<br>
	<p class="text-center"><i>"Terima Kasih Atas Pembelian Anda"</i></p>

</div>
</body>
</html>
