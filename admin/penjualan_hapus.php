<?php
include '../koneksi.php';

// ambil id_jual dari URL
$id_jual = $_GET['id'];

// ambil data penjualan
$data = mysqli_query($conn,"
  SELECT * FROM penjualan WHERE id_jual='$id_jual'
");
$p = mysqli_fetch_assoc($data);

// ambil data barang
$barang = mysqli_query($conn,"
  SELECT * FROM barang WHERE id_barang='".$p['id_barang']."'
");
$b = mysqli_fetch_assoc($barang);

// hitung jumlah barang yang dijual
// jumlah = total_harga / harga_jual
$jumlah = $p['total_harga'] / $b['harga_jual'];

// kembalikan stok
mysqli_query($conn,"
  UPDATE barang SET stok = stok + $jumlah
  WHERE id_barang='".$p['id_barang']."'
");

// hapus data penjualan
mysqli_query($conn,"
  DELETE FROM penjualan WHERE id_jual='$id_jual'
");

// kembali ke halaman penjualan
header("Location: penjualan.php");
