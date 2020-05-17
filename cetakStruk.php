<?php 

include "koneksi.php";
include "functions.php";
//     notransaksi 
//     Tahun Bulan idMenu id
//      2020 05 001 001
//    2020050001
$noTransaksi = "";
// BUATTT FORMAT DATEEEEEE!!!!!!!!!!!!!!!!!!
$idSumber = $_POST['idSumber'];
$tanggal = $_POST['tanggal'];
$inputUang = $_POST['inputUang'];
$total = $_POST['total'];
$kembalian = (int)$inputUang - (int)$total;
$nomor = query("SELECT no_transaksi FROM order_detail ORDER BY tanggal DESC LIMIT 1");
$idOrderDetail = substr($nomor[0]['no_transaksi'],6,);
var_dump($idOrderDetail);
echo $nomor[0]['no_transaksi'];
echo "<br>";
echo substr($nomor[0]['no_transaksi'],6,);
echo "<br>";
echo substr($nomor[0]['no_transaksi'],0,6);
echo "<br>";
var_dump($tanggal);
echo "<br>";
var_dump($inputUang);
echo "<br>";
var_dump($total);
echo "<br>";
var_dump($kembalian);


