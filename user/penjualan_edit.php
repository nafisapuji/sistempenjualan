<?php
include 'header.php';
include '../koneksi.php';

// ambil id jual
$id = $_GET['id'];

// ambil data penjualan
$p = mysqli_fetch_assoc(mysqli_query($conn,"
  SELECT * FROM penjualan WHERE id_jual='$id'
"));

// ambil data barang lama
$b_lama = mysqli_fetch_assoc(mysqli_query($conn,"
  SELECT * FROM barang WHERE id_barang='".$p['id_barang']."'
"));

// hitung jumlah lama
$jumlah_lama = $p['total_harga'] / $b_lama['harga_jual'];

// ambil semua barang
$barang = mysqli_query($conn,"SELECT * FROM barang");
?>

<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4>Edit Transaksi Penjualan</h4>
    </div>

    <div class="panel-body">
      <form method="post" action="penjualan_update.php">

        <input type="hidden" name="id_jual" value="<?php echo $p['id_jual']; ?>">
        <input type="hidden" name="id_barang_lama" value="<?php echo $p['id_barang']; ?>">
        <input type="hidden" name="jumlah_lama" value="<?php echo $jumlah_lama; ?>">

        <div class="form-group">
          <label>Nama Barang</label>
          <select name="id_barang" class="form-control" required>
            <?php while($b = mysqli_fetch_assoc($barang)){ ?>
              <option value="<?php echo $b['id_barang']; ?>"
                <?php if($b['id_barang']==$p['id_barang']) echo "selected"; ?>>
                <?php echo $b['nama_barang']; ?> (Stok: <?php echo $b['stok']; ?>)
              </option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Jumlah Jual</label>
          <input type="number" name="jumlah" class="form-control"
            value="<?php echo $jumlah_lama; ?>" min="1" required>
        </div>

        <div class="form-group">
          <label>Tanggal Jual</label>
          <input type="date" name="tgl_jual"
            value="<?php echo $p['tgl_jual']; ?>" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
          <i class="glyphicon glyphicon-save"></i> Update
        </button>
        <a href="penjualan.php" class="btn btn-danger">
          <i class="glyphicon glyphicon-arrow-left"></i> Kembali
        </a>

      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
