<?php
include 'header.php';
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
$d = mysqli_fetch_assoc($data);
?>

<div class="container">

  <div class="panel panel-warning">
    <div class="panel-heading">
      <h4>Edit Data Barang</h4>
    </div>

    <div class="panel-body">
      <form method="post" action="barang_update.php">

        <input type="hidden" name="id_barang" value="<?php echo $d['id_barang']; ?>">

        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" name="nama_barang" class="form-control"
                 value="<?php echo $d['nama_barang']; ?>" required>
        </div>

        <div class="form-group">
          <label>Harga Beli</label>
          <input type="number" name="harga_beli" class="form-control"
                 value="<?php echo $d['harga_beli']; ?>" required>
        </div>

        <div class="form-group">
          <label>Harga Jual</label>
          <input type="number" name="harga_jual" class="form-control"
                 value="<?php echo $d['harga_jual']; ?>" required>
        </div>

        <div class="form-group">
          <label>Stok</label>
          <input type="number" name="stok" class="form-control"
                 value="<?php echo $d['stok']; ?>" required>
        </div>

        <button type="submit" class="btn btn-warning">
          <i class="glyphicon glyphicon-refresh"></i> Update
        </button>
        <a href="barang.php" class="btn btn-danger">
          <i class="glyphicon glyphicon-arrow-left"></i> Kembali
        </a>

      </form>
    </div>
  </div>

</div>

<?php include 'footer.php'; ?>
