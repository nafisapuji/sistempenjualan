<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4>Tambah Data Barang</h4>
    </div>

    <div class="panel-body">
      <form method="post" action="barang_aksi.php">

        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" name="nama_barang" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Harga Beli</label>
          <input type="number" name="harga_beli" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Harga Jual</label>
          <input type="number" name="harga_jual" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Stok</label>
          <input type="number" name="stok" class="form-control" required>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">
            <i class="glyphicon glyphicon-save"></i> Simpan
          </button>
          <a href="barang.php" class="btn btn-danger">
            <i class="glyphicon glyphicon-arrow-left"></i> Kembali
          </a>
        </div>

      </form>
    </div>
  </div>

</div>

<?php include 'footer.php'; ?>
