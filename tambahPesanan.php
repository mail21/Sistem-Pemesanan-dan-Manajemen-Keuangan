<?php

// $db = mysqli_connect("localhost","root","","restoran2");
  include "koneksi.php";
  include "functions.php";
	require 'cek-sesi.php';

    var_dump($_POST);
//    $id_order_list
//    $no_transaksi
    $quantity = $_POST['quantity'];
    $id_meja = $_POST['nomorMeja'];
    $id_menu = $_POST['idMenu'];
//  $id_user = $_POST['deskripsi'];$SESSION
    $harga 	= str_replace("Rp.", "", $_POST['harga']);
    $total 	= str_replace("Rp.", "", $_POST['total']);
    $ket = $_POST['deskripsi'];
    $id_user = $_SESSION['id_user'];

    
    mysqli_query($db,"INSERT INTO order_list VALUES (NULL, '0000000', '$id_meja', '$id_menu', '$id_user', '$harga', '$quantity', '$total', '$ket')");
    // if($cek){
    //   echo "berhasil";
    // }else{
    //   echo "gagal";
    //   echo mysqli_error($db);
    // }
    
    mysqli_query($db, "UPDATE meja SET id_reservasi = '1', id_user = '$id_user' ,status = 'aktif' WHERE id_meja = $id_meja");
    header("location:index.php");



