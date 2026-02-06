<?php include 'header.php'; ?>

<div class="container">
  <div class="panel">
    <div class="panel-heading">
      <h4>Data Transaksi Penjualan</h4>
    </div>
    <div class="panel-body">

      <a href="penjualan_tambah.php" class="btn btn-sm btn-info pull-right">
        Transaksi Baru
      </a>
      
      <br/>
      <br/>

      <table class="table table-bordered table-striped">
        <tr>
          <th width="1%">No</th>
          <th>Invoice</th>
          <th>Tanggal</th>
          <th>Nama Barang</th>
          <th>Harga Barang</th>
          <th>Total Harga</th>
          <th>Kasir</th>
          <th width="20%">OPSI</th>
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
        ");

        $no = 1;
        while($d = mysqli_fetch_assoc($data)){
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td>INV-<?php echo $d['id_jual']; ?></td>
            <td><?php echo $d['tgl_jual']; ?></td>
            <td><?php echo $d['nama_barang']; ?></td>
            <td><?php echo "Rp. ".number_format($d['harga_jual']); ?></td>
            <td><?php echo "Rp. ".number_format($d['total_harga']); ?></td>
            <td><?php echo $d['user_nama']; ?></td>
            <td>
              <a href="penjualan_invoice.php?id=<?php echo $d['id_jual']; ?>" target="_blank" class="btn btn-sm btn-warning">
                Invoice
              </a>
              <a href="penjualan_edit.php?id=<?php echo $d['id_jual']; ?>"
                 class="btn btn-sm btn-info"
                 onclick="return confirm('Yakin edit transaksi ini?')">
                 Edit
              </a>
              <a href="penjualan_hapus.php?id=<?php echo $d['id_jual']; ?>"
                 class="btn btn-sm btn-danger"
                 onclick="return confirm('Yakin hapus transaksi ini?')">
                 Batalkan
              </a>

            </td>
          </tr>
        <?php 
        }
        ?>
      </table>
    </div>
  </div>
</div>
