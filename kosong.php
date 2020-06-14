<?php 
include "koneksi.php";
include "functions.php";

$antri = $_GET['antri'];
//dapatkan idReservasi
$id_reservasi = substr($antri,0,2);
echo "<br>";

var_dump($antri);
echo "<br>";
$arrayAntri = explode(",",$antri);
var_dump($arrayAntri);
$lengthArray =count($arrayAntri);
echo "<br>";
array_splice($arrayAntri,0,1);
var_dump($arrayAntri);
$newAntri = $arrayAntri[0];
echo "<br>";
var_dump($newAntri);
echo "<br>";
$antrian = implode(",",$arrayAntri);
var_dump($antrian);
if($lengthArray>1){
    $query1 = "UPDATE meja SET id_reservasi = '$newAntri', antrian = '$antrian' WHERE id_reservasi = '$id_reservasi'";
    mysqli_query($db,$query1);
    header("location:index.php");
}else{
   $query2 = "UPDATE meja SET id_reservasi = 1, status = 'kosong', antrian = '' WHERE id_reservasi = '$id_reservasi'";
    mysqli_query($db,$query2);
    header("location:index.php");
}
