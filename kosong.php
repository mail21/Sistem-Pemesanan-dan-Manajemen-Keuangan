<?php 
include "koneksi.php";
include "functions.php";

$antri = $_GET['antri'];
//dapatkan idReservasi
if($antri >= "100"){
$id_reservasi = substr($antri,0,3);
}else{
$id_reservasi = substr($antri,0,2);
}
echo "<br>";

var_dump($id_reservasi) ;
echo "<br>";
var_dump($antri);
echo "<br>";
$arrayAntri = explode(",",$antri);
var_dump($arrayAntri);
$lengthArray =count($arrayAntri);
echo "<br>";
array_splice($arrayAntri,0,1);
echo "arrayantri : ";
var_dump($arrayAntri);
$newAntri = $arrayAntri[0];
echo "<br>";
var_dump($newAntri);
echo "<br> ini antrian";
$antrian = implode(",",$arrayAntri);
$newAntrian = substr($antrian,0,2);
var_dump($antrian);
echo "<br>";

if($lengthArray>1){
    $query1 = "UPDATE meja SET id_reservasi = '$newAntrian', antrian = '$antrian' WHERE id_meja = " . $_GET['meja'];
    var_dump($query1);
    $res = mysqli_query($db,$query1);
    header("location:index.php");
}else{
   $query2 = "UPDATE meja SET id_reservasi = 1, status = 'kosong', antrian = '' WHERE id_reservasi = '$id_reservasi'";
   var_dump($query2);
   mysqli_query($db,$query2);
    header("location:index.php");
}
