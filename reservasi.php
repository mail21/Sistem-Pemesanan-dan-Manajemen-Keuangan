<?php 

	include "koneksi.php";
	include "functions.php";
	require 'cek-sesi.php';
	$date = date("Y-m-d");
	$waktu = $_POST['jam'] . ":".$_POST['menit'] . "-" .$_POST['jam2'] . ":".$_POST['menit2'];
	// var_dump($_SESSION['id_user']);
	$id_user = $_SESSION['id_user'];
	$tambah = $_POST['tambah'] || false;
	$result = mysqli_query($db,"SELECT * FROM reservasi");
	$antrianQuery = mysqli_query($db,"SELECT jamAntri,antrian FROM meja WHERE id_meja = ".$_POST['id']);
	$listAntrian = mysqli_fetch_assoc($antrianQuery);
	$antrian = $listAntrian['jamAntri']. "," . $waktu;
	$jmlReservasi = mysqli_num_rows($result) + 1;
	$tambahReservasi = $listAntrian['antrian']. "," .$jmlReservasi;
	if($tambah){
		mysqli_query($db,"INSERT INTO `reservasi` (`id_reservasi`, `id_user`, `tanggal_reservasi`, `jam`, `nama_pelanggan`, `no_telp`, `email`) VALUES (NULL, '$id_user', '".$date."', '".$waktu."', '".$_POST['nama']."', '".$_POST['no']."', '".$_POST['email']."')");
		$antri = $antrian;
		$reservasi = $tambahReservasi;
		mysqli_query($db,"UPDATE meja SET jamAntri = '$antri', antrian = '$reservasi' WHERE id_meja = ".$_POST['id']);	
		header("location:index.php");
	}else{
		mysqli_query($db,"INSERT INTO `reservasi` (`id_reservasi`, `id_user`, `tanggal_reservasi`, `jam`, `nama_pelanggan`, `no_telp`, `email`) VALUES (NULL, '$id_user', NOW(), '".$waktu."', '".$_POST['nama']."', '".$_POST['no']."', '".$_POST['email']."')");
		$antri = $waktu;
		$reservasi = $jmlReservasi;
		mysqli_query($db,"UPDATE meja SET id_reservasi = $jmlReservasi, status = 'reservasi', jamAntri = '$antri', antrian = '$reservasi'  WHERE id_meja = ".$_POST['id']);	
		header("location:index.php");
	}
	
?>