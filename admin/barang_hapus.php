<?php
include '../koneksi.php';

$id = $_GET['id'];

$cek = mysqli_query($conn,"
    SELECT * FROM penjualan WHERE id_barang='$id'
");

if(mysqli_num_rows($cek) > 0){
    echo "<script>
        alert('Barang tidak bisa dihapus karena sudah ada transaksi penjualan!');
        window.location='barang.php';
    </script>";
}else{
    mysqli_query($conn,"DELETE FROM barang WHERE id_barang='$id'");
    header("location:barang.php");
}
