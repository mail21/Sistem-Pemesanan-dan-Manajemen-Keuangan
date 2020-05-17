<?php 
include "koneksi.php";
include "functions.php";

$nama = $_GET['nama'];
//dapatkan idReservasi
$query = "SELECT id_reservasi FROM reservasi WHERE nama_pelanggan=$nama";
$id = query($query);
$query = "UPDATE meja SET id_reservasi = 1, status = 'kosong' WHERE id_reservasi = ". $id[0]['id_reservasi'];
mysqli_query($db,$query);

header("location:index.php");
