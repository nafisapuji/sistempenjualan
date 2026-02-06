<!DOCTYPE html>
<html>
<head>
	<title>Laporan Penjualan - Cetak</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
</head>
<body>

<?php
	include '../koneksi.php';

	$dari = isset($_GET['dari']) ? $_GET['dari'] : '';
	$sampai = isset($_GET['sampai']) ? $_GET['sampai'] : '';

	if ($dari == '' || $sampai == '') {
		die("Tanggal laporan belum dipilih.");
	}

	// Query laporan penjualan sesuai DB kamu
	$data = mysqli_query($conn, "
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
		WHERE DATE(p.tgl_jual) >= '$dari'
		  AND DATE(p.tgl_jual) <= '$sampai'
		ORDER BY p.id_jual DESC
	");
?>

<div class="container">
	<center>
		<h3>LAPORAN PENJUALAN</h3>
		<h4>Dari <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b></h4>
	</center>

	<br>

	<table class="table table-bordered table-striped">
		<tr>
			<th width="1%">No</th>
			<th>Invoice</th>
			<th>Tanggal</th>
			<th>Barang</th>
			<th>Harga Jual</th>
			<th>Jumlah</th>
			<th>Total</th>
			<th>Kasir</th>
		</tr>

		<?php
			$no = 1;
			$grand = 0;

			while ($d = mysqli_fetch_array($data)) {
				$qty = (int)$d['jumlah'];
				$harga = (int)$d['harga_jual'];

				$total = (int)$d['total_harga'];
				if ($total <= 0) {
					$total = $qty * $harga; // fallback
				}

				$grand += $total;
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td>INVOICE-<?php echo $d['id_jual']; ?></td>
			<td><?php echo $d['tgl_jual']; ?></td>
			<td><?php echo $d['nama_barang']; ?></td>
			<td><?php echo "Rp. " . number_format($harga) . " ,-"; ?></td>
			<td><?php echo $qty; ?></td>
			<td><?php echo "Rp. " . number_format($total) . " ,-"; ?></td>
			<td><?php echo $d['user_nama']; ?></td>
		</tr>
		<?php } ?>

		<tr>
			<th colspan="6" class="text-right">Grand Total</th>
			<th colspan="2"><?php echo "Rp. " . number_format($grand) . " ,-"; ?></th>
		</tr>
	</table>
</div>

<script type="text/javascript">
	window.print();
</script>

</body>
</html>
