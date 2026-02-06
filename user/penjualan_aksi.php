<?php
include '../koneksi.php';
session_start();

$id_barang = $_POST['id_barang'];
$jumlah    = $_POST['jumlah'];
$tgl_jual  = $_POST['tgl_jual'];
$user_id   = $_SESSION['user_id'];

for($i = 0; $i < count($id_barang); $i++){

    $id  = $id_barang[$i];
    $jml = $jumlah[$i];

    // AMBIL HARGA JUAL (BUKAN harga)
    $q = mysqli_query($conn,"
        SELECT harga_jual 
        FROM barang 
        WHERE id_barang='$id'
    ");
    $b = mysqli_fetch_assoc($q);

    $total = $b['harga_jual'] * $jml;

    mysqli_query($conn,"
        INSERT INTO penjualan (id_barang, jumlah, tgl_jual, total_harga, user_id)
        VALUES ('$id', '$jml', '$tgl_jual', '$total', '$user_id')
    ");

    mysqli_query($conn,"
        UPDATE barang
        SET stok = stok - $jml
        WHERE id_barang='$id'
    ");
}

header("location:penjualan.php");
