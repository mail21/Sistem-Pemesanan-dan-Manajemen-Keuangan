<?php 

include "koneksi.php";
include "functions.php";


date_default_timezone_set('Asia/Jakarta');
// echo 'Indonesian Timezone: ' . date('d-m-Y H:i:s');
$idSumber = $_POST['idSumber'];
$id_meja = $_POST['id_meja'];
$tanggal = date("Ym");
$jamSkrng = date('H');
$inputUang = $_POST['inputUang'];
$total = $_POST['total'];
$kembalian = (int)$inputUang - (int)$total;
$nomor = query("SELECT no_transaksi FROM order_detail ORDER BY no_transaksi DESC LIMIT 1");
$antrian = query("SELECT jam,antrian FROM meja JOIN reservasi ON meja.id_reservasi = reservasi.id_reservasi WHERE id_meja = $id_meja");
$idOrderDetail = (int)substr($nomor[0]['no_transaksi'],6) + 1;
var_dump($nomor[0]['no_transaksi']);
echo "<br>";
echo "$idOrderDetail";


echo "<br><br><br><br>";
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
// header("location:index.php");
$cetakQuery = "
SELECT 
order_detail.no_transaksi AS NomorTransaksi,
order_detail.tanggal AS tanggal,
order_detail.kembalian AS kembalian,
order_list.harga AS harga,
order_list.quantity AS jumlah,
order_list.total AS total,
order_detail.total AS totalSemua,
menu.nama AS nama
FROM `order_detail` JOIN order_list ON order_list.no_transaksi = order_detail.no_transaksi 
JOIN menu ON order_list.id_menu = menu.id_menu
WHERE order_detail.no_transaksi = '$noTransaksi'";
$cetak = query($cetakQuery);

echo $inputUang;
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=struk_$noTransaksi.xls");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table{
        border: 1px solid;
    }

    td{
        width:100px;
    }
</style>
<body>
    <table >
        <tr>
            <td colspan="3" style="text-align: center;">Restoran</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;padding:2px;">Taman Pesona Bali Ruko No, Jl. Raya Cirendeu No.1, Pisangan Raya, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;padding:2px;"> <?= $cetak[0]['tanggal']; ?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;padding:2px;">
                ===========================
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;padding:2px;">
                STRUKTUR PEMBAYARAN
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;padding:2px;"> 
               PEMESANAN
            </td>
        </tr>

        <?php foreach($cetak as $item): ?>
            <tr>
                <td colspan="3"><?= $item['nama']; ?></td>
            </tr>
            <tr>
                <td style="margin-right:5px;"><?= $item['harga']; ?></td>
                <td style="text-align: right;">x<?= $item['jumlah']; ?></td>
                <td style="text-align: right;"><?= $item['total']; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" style="text-align: right;">_______________________</td>
        </tr>
        <tr>
            <td colspan="2"> Total Semua pesanan</td>
            <td style="text-align: right;">Rp. <?= number_format($cetak[0]['totalSemua'],2,',','.'); ?> </td>
        </tr>
        <tr>
            <td colspan="2">Total bayar</td>
            <td style="text-align: right;">Rp. <?php echo  number_format($inputUang,2,',','.'); ?>  </td>
        </tr>
        <tr>
            <td colspan="2">Kembalian</td>
            <td style="text-align: right;">Rp. <?= number_format($cetak[0]['kembalian'],2,',','.'); ?></td>
        </tr>

        <tr>
            <td colspan="3" style="text-align: center;padding:2px;">===========================</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;padding:2px;">TERIMA KASIH</td>
        </tr>
    </table>
</body>
</html>

