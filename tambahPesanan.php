<?php

// $db = mysqli_connect("localhost","root","","restoran2");
  include "koneksi.php";
  include "functions.php";

    var_dump($_POST);
//    $id_order_list
//    $no_transaksi
    $quantity = $_POST['quantity'];
    $id_meja = $_POST['nomorMeja'];
    $id_menu = $_POST['idMenu'];
//  $id_staff = $_POST['deskripsi'];$SESSION
    $harga 	= str_replace("Rp.", "", $_POST['harga']);
    $total 	= str_replace("Rp.", "", $_POST['total']);
    $ket = $_POST['deskripsi'];
    echo $quantity . "<br>";
    echo $id_meja . "<br>";
    echo $id_menu . "<br>";
    echo $harga . "<br>";
    echo $total ."<br>";
    echo $ket . "<br>";
    
    mysqli_query($db,"INSERT INTO order_list VALUES (NULL, 'kosong', '$id_meja', '$id_menu', '1', '$harga', '$quantity', '$total', '$ket')");
    // if($cek){
    //   echo "berhasil";
    // }else{
    //   echo "gagal";
    //   echo mysqli_error($db);
    // }
    
    mysqli_query($db, "UPDATE meja SET id_reservasi = '1', status = 'aktif' WHERE id_meja = $id_meja");
    header("location:index.php");



