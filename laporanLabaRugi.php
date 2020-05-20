<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_laporan_laba_rugi.xls");
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neraca laba Rugi</title>
</head>
<style>
    td,th{
        width: 15%;
        height: 25px;
    }
</style>
<?php 
    include "koneksi.php";
    include "functions.php";
    date_default_timezone_set('Asia/Jakarta');
    $tahun = $_POST['tahun'];
    $bulan = $_POST['bulan'];
    if($bulan === "saatIni" ){
       $totalPendapatan = query("SELECT SUM(total) AS total FROM order_detail");
       $tahun = date("Y");
      $bulan = date("m");
    }else{
       $totalPendapatan = query("SELECT SUM(total) AS total FROM `order_detail` WHERE tanggal LIKE '$tahun-$bulan-%'"); 
    }
    $pengeluaran = query("SELECT jumlah FROM pengeluaran WHERE tgl_pengeluaran LIKE '$tahun-$bulan-%'");
    $totalPengeluaran = query("SELECT SUM(jumlah) AS total FROM pengeluaran WHERE tgl_pengeluaran LIKE '$tahun-$bulan-%'");
    $laba =(int)$totalPendapatan[0]['total'] - (int)$totalPengeluaran[0]['total'];
    
?>

<body>
    <table border="1">
        <tr>
            <th colspan="4">LAPORAN LABA RUGI</th>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>  
      <tr>
        <th>Pendapatan</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>

      <tr>
         <td>Pendapatan Restoran</td>
         <td></td>
         <td>Rp. <?= number_format($totalPendapatan[0]['total']) ?></td>
         <td></td>
      </tr>

      <tr>
        <td>Total Pendapatan</td>
        <td></td>
        <td></td>
        <td>Rp. <?= number_format($totalPendapatan[0]['total']) ?></td>
     </tr>

     <tr>
        <th>Biaya-Biaya</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>

     <tr>
        <td>Gaji Pegawai</td>
        <td></td>
        <td>Rp. <?= number_format($pengeluaran[0]['jumlah']) ?></td>
        <td></td>
     </tr>

     <tr>
        <td>Listrik</td>
        <td></td>
        <td>Rp. <?= number_format($pengeluaran[5]['jumlah']) ?></td>
        <td></td>
     </tr>

     <tr>
        <td>Telpon & Internet</td>
        <td></td>
        <td>Rp. <?= number_format($pengeluaran[1]['jumlah']) ?></td>
        <td></td>
     </tr>

     <tr>
        <td>Perlengkapan Kantor</td>
        <td></td>
        <td>Rp. <?= number_format($pengeluaran[2]['jumlah']) ?></td>
        <td></td>
     </tr>

     <tr>
        <td>Transportasi & Bensin</td>
        <td></td>
        <td>Rp. <?= number_format($pengeluaran[3]['jumlah']) ?></td>
        <td></td>
     </tr>

     <tr>
        <td>Biaya Tidak terduga</td>
        <td></td>
        <td>Rp. <?= number_format($pengeluaran[4]['jumlah']) ?></td>
        <td></td>
     </tr>

     <tr>
        <td>Totak Biaya</td>
        <td></td>
        <td></td>
        <td>Rp. <?= number_format($totalPengeluaran[0]['total']) ?></td>
     </tr>
     <tr>
        <th>Laba Bersih</th>
        <td></td>
        <td></td>
        <th>Rp. <?= number_format($laba) ?></th>
     </tr>
        
    </table>
    
</body>
</html>