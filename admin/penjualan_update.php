<?php
include '../koneksi.php';

$id_jual         = $_POST['id_jual'];
$id_barang_baru  = $_POST['id_barang'];
$id_barang_lama  = $_POST['id_barang_lama'];
$jumlah_baru     = $_POST['jumlah'];
$jumlah_lama     = $_POST['jumlah_lama'];
$tgl_jual        = $_POST['tgl_jual'];

// kembalikan stok lama
mysqli_query($conn,"
  UPDATE barang SET stok = stok + $jumlah_lama
  WHERE id_barang='$id_barang_lama'
");

// ambil data barang baru
$b = mysqli_fetch_assoc(mysqli_query($conn,"
  SELECT * FROM barang WHERE id_barang='$id_barang_baru'
"));

$harga = $b['harga_jual'];
$stok  = $b['stok'];

// cek stok baru
if($jumlah_baru > $stok){
  echo "<script>alert('Stok tidak cukup!');history.back();</script>";
  exit;
}

$total_harga = $harga * $jumlah_baru;

// update penjualan
mysqli_query($conn,"
  UPDATE penjualan SET
    id_barang='$id_barang_baru',
    tgl_jual='$tgl_jual',
    total_harga='$total_harga'
  WHERE id_jual='$id_jual'
");

// kurangi stok baru
mysqli_query($conn,"
  UPDATE barang SET stok = stok - $jumlah_baru
  WHERE id_barang='$id_barang_baru'
");

echo "<script>alert('Data telah diubah'); window.location.href='penjualan.php'</script>";
