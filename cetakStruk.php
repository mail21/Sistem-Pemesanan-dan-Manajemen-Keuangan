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
echo "strlen";
var_dump(strlen($antrian[0]['antrian']));
echo $antrian[0]['antrian'];
echo "<br>";
var_dump(substr($antrian[0]['jam'],0,2));
$antrianStr =  explode(",",$antrian[0]['antrian']);
array_splice($antrianStr,0,1);
echo "<br>";
var_dump($antrianStr);
// echo "jam skrng : " . $jamSkrng; 
// echo "<br>";
// echo "Tanggal : ". $tanggal . $idOrderDetail;
$noTransaksi = $tanggal . $idOrderDetail;
$date = date('Y-m-d H:i:s');
// if(strlen ($antrian[0]['antrian']) >= 3 ){
//     $antrianStr = substr($antrian[0]['antrian'],3);
// }else{
//     $antrianStr = substr($antrian[0]['antrian'],2);
// }
echo "<br>";

var_dump($antrianStr);
echo "<br>" .count($antrianStr);
echo "<br>";

$antrianString = implode(",",$antrianStr);

if(count($antrianStr)>=1){
    if($jamSkrng < substr($antrian[0]['jam'],0,2)){
        mysqli_query($db,"UPDATE meja SET  status = 'reservasi' WHERE id_meja = $id_meja");
        echo "cuma ubah status doang";
    }else{
        mysqli_query($db,"UPDATE meja SET id_reservasi = '$antrianStr[0]', status = 'reservasi', antrian = '$antrianString' WHERE id_meja = $id_meja");
        echo "next ke meja berikutnya";
    }
}else{
    if($jamSkrng < substr($antrian[0]['jam'],0,2)){
        mysqli_query($db,"UPDATE meja SET  status = 'reservasi' WHERE id_meja = $id_meja");
        echo "cuma ubah status doang";
    }else{
        mysqli_query($db,"UPDATE meja SET id_reservasi = '1', status = 'kosong', antrian = '' WHERE id_meja = $id_meja");
        echo "udah gak ada meja lagi";
    }
}
mysqli_query($db,"INSERT INTO `order_detail` (`no_transaksi`, `id_sumber`, `tanggal`, `total`, `kembalian`) VALUES ('$noTransaksi', '1', '$date', '$total', '$kembalian')");
mysqli_query($db,"UPDATE `order_list` SET `no_transaksi` = '$noTransaksi' WHERE `order_list`.`id_meja` = $id_meja AND no_transaksi = '0000000' ");
header("location:index.php");





