<?php 

include "koneksi.php";
include "functions.php";

$tidakTerduga = $_POST['tidakTerduga'];
$transportasi = $_POST['transportasi'];
$perlengkapan = $_POST['perlengkapan'];
$telpon = $_POST['telpon'];
$listrik = $_POST['listrik'];
$gajiPegawai = $_POST['gajiPegawai'];
$tanggal = query("SELECT tgl_pengeluaran FROM pengeluaran ORDER BY id_pengeluaran DESC LIMIT 1");
date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d H:i:s');
$tanggalTerakhir = substr($tanggal[0]["tgl_pengeluaran"] ,5,2);
$tanggalSkrng = substr($date,5,2);
var_dump($tanggalSkrng);
var_dump($tanggalTerakhir);
if($tanggalSkrng === $tanggalTerakhir ){
    echo "Tanggal Sama";
    // sudah di input
}else{
    echo "Tanggal Tidak Sama";
    // belom diinput
}

mysqli_query($db, "INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_sumber`, `tgl_pengeluaran`, `jumlah`) VALUES (NULL, '2', '$date', '$gajiPegawai')");
mysqli_query($db, "INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_sumber`, `tgl_pengeluaran`, `jumlah`) VALUES (NULL, '3', '$date', '$telpon')");
mysqli_query($db, "INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_sumber`, `tgl_pengeluaran`, `jumlah`) VALUES (NULL, '4', '$date', '$perlengkapan')");
mysqli_query($db, "INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_sumber`, `tgl_pengeluaran`, `jumlah`) VALUES (NULL, '5', '$date', '$transportasi')");
mysqli_query($db, "INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_sumber`, `tgl_pengeluaran`, `jumlah`) VALUES (NULL, '6', '$date', '$tidakTerduga')");
mysqli_query($db, "INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_sumber`, `tgl_pengeluaran`, `jumlah`) VALUES (NULL, '7', '$date', '$listrik')");
header("location:menuLaporan.php");
