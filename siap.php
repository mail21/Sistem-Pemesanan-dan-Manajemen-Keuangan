<?php
session_start();
 
include 'koneksi.php';
if(isset($_GET['siap']) && $_GET['tipe'] == "Koki"){
    mysqli_query($db,"UPDATE order_list SET siap='".$_GET['siap']."' WHERE id_order_list = ".$_GET['id']);
    header("location:index.php");
}else if(isset($_GET['saji']) && $_GET['tipe'] == "Pelayan"){
    mysqli_query($db,"UPDATE order_list SET saji='".$_GET['saji']."' WHERE id_order_list = ".$_GET['id']);
    header("location:index.php");
}else{
    header("location:index.php");
}
