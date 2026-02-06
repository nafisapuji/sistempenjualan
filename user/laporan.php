<?php
	include 'header.php';
?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Filter Laporan</h4>
		</div>
		<div class="panel-body">
			<form action="laporan.php" method="get">
				<table class="table table-bordered table-striped">
					<tr>
						<th>Dari Tanggal</th>
						<th>Sampai Tanggal</th>
						<th width="1%"></th>
					</tr>
					<tr>
						<td>
							<br>
							<input type="date" name="tgl_dari" class="form-control" value="<?php echo isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : ''; ?>">
						</td>
						<td>
							<br>
							<input type="date" name="tgl_sampai" class="form-control" value="<?php echo isset($_GET['tgl_sampai']) ? $_GET['tgl_sampai'] : ''; ?>">
						</td>
						<td>
							<br>
							<input type="submit" class="btn btn-primary" value="Filter">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<br>

	<?php
		if (isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])) {
			$dari = $_GET['tgl_dari'];
			$sampai = $_GET['tgl_sampai'];
	?>
		<div class="panel">
			<div class="panel-heading">
				<h4>Data Laporan Penjualan dari <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b></h4>
			</div>
			<div class="panel-body">
				<a target="_blank" href="laporan_cetak.php?dari=<?php echo $dari; ?>&sampai=<?php echo $sampai; ?>" class="btn btn-primary">
					<i class="glyphicon glyphicon-print"></i> Cetak
				</a>
				<br><br>

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
						include '../koneksi.php';

						// ambil data penjualan dalam range tanggal
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

						$no = 1;
						$grand = 0;

						while ($d = mysqli_fetch_array($data)) {
							$qty = (int)$d['jumlah'];
							$harga = (int)$d['harga_jual'];

							$total = (int)$d['total_harga'];
							if ($total <= 0) {
								$total = $qty * $harga; // fallback kalau total_harga kosong
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
		</div>
	<?php } ?>
</div>
