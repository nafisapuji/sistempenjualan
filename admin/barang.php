<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4>Data Barang</h4>
    </div>

    <div class="panel-body">

      <!-- Tombol tambah -->
      <a href="barang_tambah.php" class="btn btn-primary btn-sm">
        <i class="glyphicon glyphicon-plus"></i> Tambah Barang
      </a>

      <br><br>

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th width="150">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $no = 1;
          $data = mysqli_query($conn, "SELECT * FROM barang ORDER BY id_barang DESC");
          while ($d = mysqli_fetch_array($data)) {
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['nama_barang']; ?></td>
            <td>Rp <?php echo number_format($d['harga_beli']); ?></td>
            <td>Rp <?php echo number_format($d['harga_jual']); ?></td>
            <td><?php echo $d['stok']; ?></td>
            <td>
              <a href="barang_edit.php?id=<?php echo $d['id_barang']; ?>" class="btn btn-warning btn-sm">
                <i class="glyphicon glyphicon-edit"></i>
              </a>
              <a href="barang_hapus.php?id=<?php echo $d['id_barang']; ?>"
                 onclick="return confirm('Yakin hapus data?')"
                 class="btn btn-danger btn-sm">
                <i class="glyphicon glyphicon-trash"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>

      </table>

    </div>
  </div>

</div>

<?php include 'footer.php'; ?>
