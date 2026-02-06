<?php
include 'header.php';
include '../koneksi.php';

$barang = mysqli_query($conn,"SELECT * FROM barang");
?>

<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Tambah Transaksi Penjualan</h4>
		</div>

		<div class="panel-body">
			<form method="post" action="penjualan_aksi.php">

				<div id="barang-wrapper">
					<div class="barang-item">
						<div class="form-group">
							<label>Nama Barang</label>
							<select name="id_barang[]" class="form-control" required>
								<option value="">-- Pilih Barang --</option>
								<?php while($b = mysqli_fetch_assoc($barang)){ ?>
									<option value="<?= $b['id_barang']; ?>">
										<?= $b['nama_barang']; ?> (Stok: <?= $b['stok']; ?>)
									</option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Jumlah Jual</label>
							<input type="number" name="jumlah[]" class="form-control" min="1" required>
						</div>

						<hr>
					</div>
				</div>

				<div class="form-group">
					<label>Tanggal Jual</label>
					<input type="date" name="tgl_jual" class="form-control" required>
				</div>

				<button type="button" class="btn btn-success" onclick="tambahBarang()">
					<i class="glyphicon glyphicon-plus"></i> Tambah Barang
				</button>

				<br><br>

				<button type="submit" class="btn btn-primary">
					<i class="glyphicon glyphicon-save"></i> Simpan
				</button>
				<a href="penjualan.php" class="btn btn-danger">
					<i class="glyphicon glyphicon-arrow-left"></i> Kembali
				</a>

			</form>
		</div>
	</div>
</div>

<script>
function tambahBarang(){
	let wrapper = document.getElementById("barang-wrapper");
	let item = wrapper.children[0].cloneNode(true);

	// reset input
	item.querySelector("select").value = "";
	item.querySelector("input").value = "";

	wrapper.appendChild(item);
}
</script>

<?php include 'footer.php'; ?>
