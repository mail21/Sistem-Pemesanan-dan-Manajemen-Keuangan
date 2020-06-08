<?php 

	include "koneksi.php";
	include "functions.php";
	require 'cek-sesi.php';
	$date = date("Y-m-d");
	$waktu = $_POST['jam'] . ":".$_POST['menit'];
	// var_dump($_SESSION['id_user']);
	$id_user = $_SESSION['id_user'];
	mysqli_query($db,"INSERT INTO `reservasi` (`id_reservasi`, `id_user`, `tanggal_reservasi`, `jam`, `nama_pelanggan`, `no_telp`) VALUES (NULL, '$id_user', '".$date."', '".$waktu."', '".$_POST['nama']."', '".$_POST['no']."')");
	$result = mysqli_query($db,"SELECT * FROM reservasi");
	$jmlReservasi = mysqli_num_rows($result);
	mysqli_query($db,"UPDATE meja SET id_reservasi = $jmlReservasi, status = 'reservasi' WHERE id_meja = ".$_POST['id']);
	header("location:index.php");
?>