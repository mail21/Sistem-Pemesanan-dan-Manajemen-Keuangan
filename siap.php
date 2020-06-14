<?php
session_start();
 
include 'koneksi.php';
if(isset($_GET['siap'])){
    mysqli_query($db,"UPDATE order_list SET siap='".$_GET['siap']."' WHERE id_order_list = ".$_GET['id']);
    header("location:index.php");
}else{
    mysqli_query($db,"UPDATE order_list SET saji='".$_GET['saji']."' WHERE id_order_list = ".$_GET['id']);
    header("location:index.php");
}
