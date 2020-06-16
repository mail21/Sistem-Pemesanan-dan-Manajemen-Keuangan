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
$jamSkrng = date('H');
$inputUang = $_POST['inputUang'];
$total = $_POST['total'];
$kembalian = (int)$inputUang - (int)$total;
$nomor = query("SELECT no_transaksi FROM order_detail ORDER BY tanggal DESC LIMIT 1");
$antrian = query("SELECT jam,antrian FROM meja JOIN reservasi ON meja.id_reservasi = reservasi.id_reservasi WHERE id_meja = $id_meja");
$idOrderDetail = (int)substr($nomor[0]['no_transaksi'],6) + 1;
var_dump(strlen($antrian[0]['antrian']));
echo $antrian[0]['antrian'];
echo "<br>";
var_dump(substr($antrian[0]['jam'],0,2));

echo "<br>";
echo "jam skrng : " . $jamSkrng; 
echo "<br>";
echo "Tanggal : ". $tanggal . $idOrderDetail;
$noTransaksi = $tanggal . $idOrderDetail;
$date = date('Y-m-d H:i:s');
var_dump($date);
if(strlen ($antrian[0]['antrian']) >= 3 ){
    $antrianStr = substr($antrian[0]['antrian'],3);
}else{
    $antrianStr = substr($antrian[0]['antrian'],2);
}
$nextMeja = substr($antrianStr, 0, 2);
var_dump($nextMeja);
if(strlen($nextMeja ) >= 2){
    if($jamSkrng < substr($antrian[0]['jam'],0,2)){
        mysqli_query($db,"UPDATE meja SET  status = 'reservasi' WHERE id_meja = $id_meja");
    }else{
        mysqli_query($db,"UPDATE meja SET id_reservasi = '$nextMeja', status = 'reservasi', antrian = '$antrianStr' WHERE id_meja = $id_meja");
    }
}else{
    mysqli_query($db,"UPDATE meja SET id_reservasi = '1', status = 'kosong', antrian = '$antrianStr' WHERE id_meja = $id_meja");
}

mysqli_query($db,"INSERT INTO `order_detail` (`no_transaksi`, `id_sumber`, `tanggal`, `total`, `kembalian`) VALUES ('$noTransaksi', '1', '$date', '$total', '$kembalian')");
mysqli_query($db,"UPDATE `order_list` SET `no_transaksi` = '$noTransaksi' WHERE `order_list`.`id_meja` = $id_meja AND no_transaksi = '0000000' ");
header("location:index.php");




