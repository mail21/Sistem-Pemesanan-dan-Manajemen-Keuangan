<?php

$db = mysqli_connect("localhost","root","","restoran2");

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

    // INSERT INTO `order_list` (`id_order_list`, `no_transaksi`, `id_meja`, `id_menu`, `id_staff`, `harga`, `quantity`, `total`, `ket`) VALUES (NULL, '', '1', '1', '1', '12', '2', '123', 'sad')
    $query = "INSERT INTO `order_list` (`id_order_list`, `no_transaksi`, `id_meja`, `id_menu`, `id_staff`, `harga`, `quantity`, `total`, `ket`) VALUES (NULL, '0', '$id_meja', '$id_menu', '1', '$harga', '$quantity', '$total', '$ket')";
    
    if (mysqli_query($db,$query)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $query . "<br>" . mysqli_error($db);
      }
    header("location:index.php");



