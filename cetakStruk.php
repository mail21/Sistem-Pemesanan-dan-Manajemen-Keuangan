<?php 

include "koneksi.php";
include "functions.php";


date_default_timezone_set('Asia/Jakarta');
echo 'Indonesian Timezone: ' . date('d-m-Y H:i:s');
//     notransaksi 
//     Tahun Bulan idMenu id
//      2020 05 001 001
//    2020050001
$idSumber = $_POST['idSumber'];
$id_meja = $_POST['id_meja'];
$tanggal = date("Ym");
$inputUang = $_POST['inputUang'];
$total = $_POST['total'];
$kembalian = (int)$inputUang - (int)$total;
$nomor = query("SELECT no_transaksi FROM order_detail ORDER BY tanggal DESC LIMIT 1");
$idOrderDetail = (int)substr($nomor[0]['no_transaksi'],6,) + 1;
var_dump($idOrderDetail);
echo "<br>";
echo $nomor[0]['no_transaksi'];
echo "<br>";
echo substr($nomor[0]['no_transaksi'],6,);
echo "<br>";
echo "Tanggal : ". $tanggal . $idOrderDetail;
$noTransaksi = $tanggal . $idOrderDetail;
$date = date('Y-m-d H:i:s');
var_dump($date);
mysqli_query($db,"INSERT INTO `order_detail` (`no_transaksi`, `id_sumber`, `tanggal`, `total`, `kembalian`) VALUES ('$noTransaksi', '1', '$date', '$total', '$kembalian')");
mysqli_query($db,"UPDATE meja SET id_reservasi = 1, status = 'kosong' WHERE id_meja = $id_meja");
mysqli_query($db,"UPDATE `order_list` SET `no_transaksi` = '$noTransaksi' WHERE `order_list`.`id_meja` = $id_meja AND no_transaksi = '0000000' ");
header("location:index.php");




