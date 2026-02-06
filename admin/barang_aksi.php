<?php
include '../koneksi.php';

// ambil data dari form
$nama_barang = $_POST['nama_barang'];
$harga_beli  = $_POST['harga_beli'];
$harga_jual  = $_POST['harga_jual'];
$stok        = $_POST['stok'];

// simpan ke database
mysqli_query($conn,
    "INSERT INTO barang 
    (nama_barang, harga_beli, harga_jual, stok)
    VALUES 
    ('$nama_barang','$harga_beli','$harga_jual','$stok')"
);

// kembali ke halaman barang
header("Location: barang.php");
