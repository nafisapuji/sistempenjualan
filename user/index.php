<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
  <div class="alert alert-info text-center">
    <h4><b>Selamat Datang!</b> di Sistem Informasi Penjualan</h4>
  </div>

  <div class="row">

    <!-- Jumlah User -->
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h1>
            <i class="glyphicon glyphicon-user"></i>
            <span class="pull-right">
              <?php
                $user = mysqli_query($conn, "SELECT * FROM user");
                echo mysqli_num_rows($user);
              ?>
            </span>
          </h1>
          Jumlah User
        </div>
      </div>
    </div>

    <!-- Jumlah Barang -->
    <div class="col-md-4">
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h1>
            <i class="glyphicon glyphicon-th-large"></i>
            <span class="pull-right">
              <?php
                $barang = mysqli_query($conn, "SELECT * FROM barang");
                echo mysqli_num_rows($barang);
              ?>
            </span>
          </h1>
          Jumlah Barang
        </div>
      </div>
    </div>

    <!-- Jumlah Penjualan -->
    <div class="col-md-4">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h1>
            <i class="glyphicon glyphicon-shopping-cart"></i>
            <span class="pull-right">
              <?php
                $jual = mysqli_query($conn, "SELECT * FROM penjualan");
                echo mysqli_num_rows($jual);
              ?>
            </span>
          </h1>
          Total Penjualan
        </div>
      </div>
    </div>

  </div>
</div>

<div class="panel">
	<div class="panel-heading">
		<h4>Riwayat Transaksi Penjualan Terakhir</h4>
	</div>
	<div class="panel-body">
		<table class="table table-bordered table-striped">
			<tr>
				<th width="1%">NO</th>
				<th>Invoice</th>
				<th>Tanggal</th>
				<th>Nama Barang</th>
				<th>Harga Barang</th>
				<th>Total Harga</th>
				<th>Kasir</th>
			</tr>

			<?php
			include '../koneksi.php';

			$data = mysqli_query($conn,"
        SELECT 
          penjualan.*,
          barang.nama_barang,
          barang.harga_jual,
          user.user_nama
        FROM penjualan
        JOIN barang ON penjualan.id_barang = barang.id_barang
        JOIN user ON penjualan.user_id = user.user_id
        ORDER BY penjualan.id_jual DESC
        LIMIT 10
      ");

			$no = 1;
			while ($d = mysqli_fetch_assoc($data)){
			?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td>INV-<?php echo $d['id_jual']; ?></td>
					<td><?php echo $d['tgl_jual']; ?></td>
					<td><?php echo $d['nama_barang']; ?></td>
					<td><?php echo "Rp. ".number_format($d['harga_jual']); ?></td>
					<td><?php echo "Rp. ".number_format($d['total_harga']); ?></td>
					<td><?php echo $d['user_nama']; ?></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</div>


<?php include 'footer.php'; ?>
